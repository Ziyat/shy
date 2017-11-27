<?php

namespace backend\models;

use common\models\Lang;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "pages".
 *
 * @property integer $id
 * @property integer $parent_id
 * @property string $lang_id
 * @property string $title
 * @property string $type
 * @property integer $type_helper
 * @property integer $text
 * @property integer $is_public
 * @property integer $position
 */
class Pages extends ActiveRecord
{
   /*
    *     * @inheritdoc
    */

   public static function tableName()
   {
      return 'pages';
   }

   const STATUS_PAGE_NOT_PUBLIC = 0;
   const STATUS_PAGE_PUBLIC = 1;
   const STATUS_NOT_IN_TOP_MENU = 0;
   const STATUS_IN_TOP_MENU = 1;
   const TYPE_ACTION = 1; // action
   const TYPE_PAGE = 2; // page content
   const TYPE_CROSSING = 3; // page crossing
   const TYPE_LINK = 4; // link
   const TYPE_EMPTY = 5; // empty == #
   const TYPE_FEED_LIST = 6; // feed shows as lists
   const TYPE_FEED_POST = 7; // feed shows as articles
   const TYPE_FEED_IMAGE = 8; // feed shows as gallery
   const TYPE_FEED_INFO = 9; // feed shows from needs

   public function typesList($param = null)
   {
      $a = [
         'types' => [],
         'feeds' => []
      ];

      // types array
      if (defined('self::TYPE_ACTION')) {
         $a['types'][self::TYPE_ACTION] = 'Предопределенный модул';
      }
      if (defined('self::TYPE_PAGE')) {
         $a['types'][self::TYPE_PAGE] = 'Страница контентом';
      }
//         if (defined('self::TYPE_CROSSING'))   { $a['types'][self::TYPE_CROSSING]   = 'Переход на другую страницу'; }
      if (defined('self::TYPE_LINK')) {
         $a['types'][self::TYPE_LINK] = 'Ссылка';
      }
      if (defined('self::TYPE_EMPTY')) {
         $a['types'][self::TYPE_EMPTY] = 'Родитель для вложения подменю';
      }
      // feeds array
//        if (defined('self::TYPE_FEED_LIST')) {$a['feeds'][self::TYPE_FEED_LIST] = 'Родительский тип - "Лист"';}
//      if (defined('self::TYPE_FEED_POST')) {
//         $a['feeds'][self::TYPE_FEED_POST] = 'Родительский тип - "Статьи"';
//      }
//      if (defined('self::TYPE_FEED_IMAGE')) {
//         $a['feeds'][self::TYPE_FEED_IMAGE] = 'Родительский тип - "Галерея"';
//      }
//         if (defined('self::TYPE_FEED_INFO')) { $a['feeds'][self::TYPE_FEED_INFO] = 'Родительский тип - "Инфо"'; }

      if (is_numeric($param)) {
         $a = $a['types'] + $a['feeds'];
         return $a[$param];
      } else {
         return ($param == 'types' || $param == 'feeds') ? $a[$param] : ($a['types'] + $a['feeds']);
      }
   }

   public function actionsList($flip = false)
   {
      $array = [
         '/' => '"Главная страница"',
         'products' => '"Продукция"',
         'faq' => '"Часто задаваемые вопросы"',
         'contacts' => '"Контакты"',
      ];
      if (is_string($flip) && array_key_exists($flip, $array)) {
         return $array[$flip];
      } elseif ($flip) {
         return array_flip($array);
      }
      return $array;
   }

   /**
    * @inheritdoc
    */
   public function rules()
   {
      return [
         [['parent_id', 'title', 'lang_id', 'type', 'is_public', 'position'], 'required'],
         [['lang_id', 'type', 'position'], 'integer'],
         [['is_in_top_menu', 'is_public'], 'boolean'],
         ['is_public', 'integer', 'min' => self::STATUS_PAGE_NOT_PUBLIC, 'max' => self::STATUS_PAGE_PUBLIC],
         ['parent_id', 'integer', 'min' => 0],
         ['parent_id', 'exist', 'targetAttribute' => 'id', 'when' => function($model) {
               return $model->parent_id > 0;
            }],
         ['title', 'string', 'max' => 255],
         ['text', 'string'],
         ['text', 'default', 'value' => ''],
         ['lang_id', 'exist', 'targetClass' => Lang::className(), 'targetAttribute' => 'id'],
         // if page is action, type_helper is action name
         ['action', 'required', 'when' => function($model) {
               return $model->type == self::TYPE_ACTION;
            }, 'enableClientValidation' => false],
         ['action', 'in', 'range' => self::actionsList(true), 'allowArray' => true, 'when' => function($model) {
               return $model->type == self::TYPE_ACTION;
            }, 'enableClientValidation' => false],
         // if page must have content, type_helper is "alias"
         [['alias'], 'required', 'when' => function($model) {
               return $model->type == self::TYPE_PAGE;
            }, 'enableClientValidation' => false],
         ['alias', 'unique', 'when' => function($model) {
               return $model->type == self::TYPE_PAGE;
            }, 'enableClientValidation' => false],
         // if page is url link
         ['link', 'required', 'when' => function($model) {
               return $model->type == self::TYPE_LINK;
            }, 'enableClientValidation' => false],
         ['link', 'url', 'when' => function($model) {
               return $model->type == self::TYPE_LINK;
            }, 'enableClientValidation' => false],
         // if page is empty(#) link for parenting
         // noting to do
         // if page is feed parent_id
         ['alias', 'required', 'when' => function($model) {
               return in_array($model->type, self::typesList('feeds'));
            }, 'enableClientValidation' => false],
         ['alias', 'unique', 'when' => function($model) {
               return in_array($model->type, self::typesList('feeds'));
            }, 'enableClientValidation' => false],
      ];
   }

   /**
    * @inheritdoc
    */
   public function attributeLabels()
   {
      return [
         'id' => Yii::t('app', 'ID'),
         'parent_id' => Yii::t('app', 'Parent'),
         'title' => Yii::t('app', 'Title'),
         'lang_id' => Yii::t('app', 'Language'),
         'type' => Yii::t('app', 'Type'),
         'text' => Yii::t('app', 'Text'),
         'is_public' => Yii::t('app', 'Is public'),
         'is_in_top_menu' => Yii::t('app', 'Is In Top Menu'),
         'position' => Yii::t('app', 'Position'),
         'action' => Yii::t('app', 'Модул'),
         'alias' => Yii::t('app', 'Алиас'),
         'link' => Yii::t('app', 'Ссылка'),
      ];
   }

   /**
    * @return ActiveQuery
    */
//   public function getLang()
//   {
//      return $this->hasOne(Lang::className(), ['id' => 'lang_id']);
//   }

   public function getParents()
   {
      return $this->hasOne(self::className(), ['id' => 'parent_id'])->from('pages' . ' p');
   }

   public function behaviors()
   {
      return [
         'timestamp' => ['class' => 'yii\behaviors\TimestampBehavior'],
      ];
   }

   public function typeFilter($model)
   {
      if ($model->type == self::TYPE_ACTION) {
         $model->alias = '';
         $model->link = '';
         $model->text = '';
      } elseif ($model->type == self::TYPE_PAGE) {
         $model->action = '';
         $model->link = '';
      } elseif ($model->type == self::TYPE_CROSSING) {
         $model->action = '';
         $model->alias = '';
         $model->link = '';
         $model->text = '';
      } elseif ($model->type == self::TYPE_LINK) {
         $model->action = '';
         $model->alias = '';
         $model->text = '';
      } elseif ($model->type == self::TYPE_EMPTY) {
         $model->action = '';
         $model->alias = '';
         $model->link = '';
         $model->text = '';
      } else {
         $model->action = '';
         $model->link = '';
         $model->text = '';
      }
      return $model;
   }

}