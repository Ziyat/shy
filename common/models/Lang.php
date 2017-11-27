<?php

namespace common\models;

use yii\base\Model;

/**
 * @property integer $id
 * @property string $url
 */
class Lang extends Model
{

    public $id;
    public $url;

    //Получения объекта языка по буквенному идентификатору
    static function getLangIdByUrl($url = null)
    {

        if ($url === 'uz') {
            return 1;
        }
        if ($url === 'ru') {
            return 2;
        }
        if ($url === 'en') {
            return 3;
        }

        if ($url === null) {
            return null;
        } else {
            $language = Lang::find()->where('url = :url', [':url' => $url])->one();
            if ($language === null) {
                return null;
            } else {
                return $language;
            }
        }
    }

    static function getLangList()
    {
        return [
            1 => 'uz',
            2 => 'ru',
            3 => 'en'
        ];
    }

}
