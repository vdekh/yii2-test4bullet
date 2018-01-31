<?php

namespace app\modules\order\entities;

use yii\db\ActiveRecord;

/**
 * Класс AR продавца
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $inn
 * @property int $checking_ac
 * @property int $corresp_ac
 * @property int $bik
 * @property string $bank
 * @property int $created_at
 *
 * @property OrderOrder[] $orderOrders
 */
class OrderSeller extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_seller';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'address' => 'Адресс',
            'inn' => 'ИНН',
            'checking_ac' => 'Расчетный счет',
            'corresp_ac' => 'Кор. счет',
            'bik' => 'БИК',
            'bank' => 'Банк',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'address', 'inn', 'checking_ac', 'corresp_ac', 'bik', 'bank', 'created_at'], 'required'],
            [['inn', 'checking_ac', 'corresp_ac', 'bik', 'created_at'], 'integer'],
            [['name', 'address', 'bank'], 'string', 'max' => 255],
        ];
    }
}
