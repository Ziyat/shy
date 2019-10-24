<?php
/**
 * Created by Madetec-Solution.
 * Developer: Mirkhanov Z.S.
 */

namespace box\services\manage\user;

use box\entities\user\Profile;
use box\entities\user\User;
use box\forms\user\PhotosForm;
use box\forms\user\ProfileForm;
use box\forms\user\UserCreateForm;
use box\repositories\UserRepository;
use box\entities\user\Profile\AddressPhone;
use box\entities\user\Profile\Passport;

class UserManageService
{
    private $users;

    public function __construct(UserRepository $userRepository)
    {
        $this->users = $userRepository;
    }

    /**
     * @param UserCreateForm $form
     * @return int
     * @throws \DomainException
     * @throws \LogicException
     * @throws \yii\base\Exception
     * @throws \yii\web\NotFoundHttpException
     */
    public function create(UserCreateForm $form)
    {
        $parent = $this->users->get($form->parent_id);
        $this->isFullTree($parent);
        $passport = new Passport(
            $form->profile->surname,
            $form->profile->given_name,
            $form->profile->father_name,
            $form->profile->nationality,
            strtotime($form->profile->date_of_birth),
            strtotime($form->profile->date_of_expiry),
            strtotime($form->profile->date_of_issue),
            $form->profile->place_of_birth,
            $form->profile->passport_number,
            $form->profile->sex
        );

        $addressPhone = new AddressPhone(
            $form->profile->phone_first,
            $form->profile->phone_second,
            $form->profile->address_first,
            $form->profile->address_second
        );

        $user = User::create(
            $form->username,
            $form->password,
            $form->status,
            Profile::create($passport, $addressPhone)
        );
        $user->appendTo($parent);
        $this->users->save($user);

        return $user->id;
    }

    /**
     * @param User $user
     * @param ProfileForm $form
     * @throws \DomainException
     */
    public function update(User $user, ProfileForm $form)
    {
        $profile = $user->profile;

        $passport = new Passport(
            $form->surname,
            $form->given_name,
            $form->father_name,
            $form->nationality,
            strtotime($form->date_of_birth),
            strtotime($form->date_of_expiry),
            strtotime($form->date_of_issue),
            $form->place_of_birth,
            $form->passport_number,
            $form->sex
        );

        $addressPhone = new AddressPhone(
            $form->phone_first,
            $form->phone_second,
            $form->address_first,
            $form->address_second
        );
        $profile->edit($passport, $addressPhone);

        $user->profile = $profile;
        $this->users->save($user);
    }

    /**
     * @param $id
     * @throws \DomainException
     * @throws \LogicException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function remove($id)
    {
        $user = $this->users->get($id);
        if ($user->isAdmin()) {
            throw new \LogicException('Вы не можете удалить!');
        }
        if ($user->isFullTree()) {
            throw new \LogicException('Вы не можете удалить! У <b>"' . $user->profile->fullName . '"</b> два партнёра');
        }
        $this->users->remove($user);
    }

    /**
     * @param $id
     * @param PhotosForm $form
     * @throws \DomainException
     * @throws \yii\web\NotFoundHttpException
     */
    public function addPhotos($id, PhotosForm $form): void
    {
        $user = $this->users->get($id);
        foreach ($form->files as $file) {
            $user->addPhoto($file);
        }
        $this->users->save($user);
    }

    /**
     * @param $from
     * @param $to
     * @throws \DomainException
     * @throws \yii\web\NotFoundHttpException
     */
    public function changeParent($from, $to)
    {
        $fromUser = $this->users->get($from);
        $toUser = $this->users->get($to);

        $fromUser->changeTo($toUser->getAttribute('lft'), $toUser->rgt, $toUser->depth);
        $toUser->changeTo($fromUser->getOldAttribute('lft'), $fromUser->getOldAttribute('rgt'), $fromUser->getOldAttribute('depth'));

        $this->users->save($fromUser);
        $this->users->save($toUser);
    }

    /**
     * @param $id
     * @param $rate_id
     * @throws \DomainException
     * @throws \yii\web\NotFoundHttpException
     */
    public function setRate($id, $rate_id)
    {
        $user = $this->users->get($id);
        $user->setRate($rate_id);
        $this->users->save($user);
    }

    /**
     * @param User $user
     * @throws \LogicException
     */
    private function isFullTree(User $user): void
    {
        if ($user->isFullTree()) {
            throw new \LogicException('Выберите другого спонсора.');
        }
    }
}
