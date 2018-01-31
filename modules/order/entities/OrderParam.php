<?php

namespace app\modules\order\entities;

use yii\db\ActiveRecord;

/**
 * Класс AR услуг
 *
 * @property int $id
 * @property string $name
 * @property string $units
 * @property int $created_at
 *
 * @property OrderParam[] $orderParam
 */
class OrderParam extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_param';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Наименование',
            'units' => 'Ед. изм',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'units', 'created_at'], 'required'],
            [['created_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['units'], 'string', 'max' => 5],
        ];
    }
}
