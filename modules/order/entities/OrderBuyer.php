<?php

namespace app\modules\order\entities;

use yii\db\ActiveRecord;

/**
 * Класс AR покупателя
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property int $inn
 * @property int $kpp
 * @property int $checking_ac
 * @property int $corresp_ac
 * @property int $bik
 * @property string $bank
 * @property int $created_at
 *
 * @property OrderOrder[] $orderOrders
 */
class OrderBuyer extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_buyer';
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
            'kpp' => 'КПП',
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
            [['name', 'address', 'inn', 'kpp', 'checking_ac', 'corresp_ac', 'bik', 'bank', 'created_at'], 'required'],
            [['inn', 'kpp', 'checking_ac', 'corresp_ac', 'bik', 'created_at'], 'integer'],
            [['name', 'address', 'bank'], 'string', 'max' => 255],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrderOrders()
    {
        return $this->hasMany(OrderOrder::className(), ['buyer_id' => 'id']);
    }

    /**
     * @param $name
     * @param $address
     * @param $inn
     * @param $kpp
     * @param $checking_ac
     * @param $corresp_ac
     * @param $bik
     * @param $bank
     * @return OrderBuyer
     */
    public static function create($name, $address, $inn, $kpp, $checking_ac, $corresp_ac, $bik, $bank): self
    {
        $buyer = new self();
        $buyer->name = $name;
        $buyer->address = $address;
        $buyer->inn = $inn;
        $buyer->kpp = $kpp;
        $buyer->checking_ac = $checking_ac;
        $buyer->corresp_ac = $corresp_ac;
        $buyer->bik = $bik;
        $buyer->bank = $bank;
        $buyer->created_at = time();
        return $buyer;
    }
}
