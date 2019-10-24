<?php

namespace box\entities\product;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%products}}".
 *
 * @property int $id
 * @property string $name
 * @property string $desc
 * @property string $img
 * @property double $in_price
 * @property double $out_price
 * @property int $category_id
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Category $category
 */
class Product extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%products}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'in_price', 'out_price', 'category_id', 'created_at', 'updated_at'], 'required'],
            [['in_price', 'out_price'], 'number'],
            [['category_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'desc', 'img'], 'string', 'max' => 255],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::class, 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'desc' => 'Desc',
            'img' => 'Img',
            'in_price' => 'In Price',
            'out_price' => 'Out Price',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }
}
