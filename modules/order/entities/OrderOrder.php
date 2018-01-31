<?php

namespace app\modules\order\entities;

use app\modules\order\services\OrderService;
use Yii;
use yii\db\ActiveRecord;

/**
 * Класс AR счёта
 *
 * @property int $id
 * @property int $seller_id
 * @property int $buyer_id
 * @property int $service_id
 * @property int $quantity
 * @property double $price
 * @property double $total
 * @property int $created_at
 *
 * @property OrderBuyer $buyer
 * @property OrderSeller $seller
 * @property OrderParam $param
 */
class OrderOrder extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order_order';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'seller_id' => 'ID продавца',
            'buyer_id' => 'ID покупателя',
            'service_id' => 'ID услуги',
            'quantity' => 'Кол-во',
            'price' => 'Цена',
            'total' => 'Сумма',
            'created_at' => 'Дата создания',
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['seller_id', 'buyer_id', 'service_id', 'quantity', 'price', 'total', 'created_at'], 'required'],
            [['seller_id', 'buyer_id', 'service_id', 'quantity', 'created_at'], 'integer'],
            [['price', 'total'], 'number'],
            [['buyer_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderBuyer::className(), 'targetAttribute' => ['buyer_id' => 'id']],
            [['seller_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderSeller::className(), 'targetAttribute' => ['seller_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => OrderParams::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBuyer()
    {
        return $this->hasOne(OrderBuyer::className(), ['id' => 'buyer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSeller()
    {
        return $this->hasOne(OrderSeller::className(), ['id' => 'seller_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParam()
    {
        return $this->hasOne(OrderParam::className(), ['id' => 'service_id']);
    }

    /**
     * @param $seller_id
     * @param $buyer_id
     * @param $service_id
     * @param $quantity
     * @param $price
     * @return OrderOrder
     */
    public static function create($seller_id, $buyer_id, $service_id, $quantity, $price): self
    {
        $order = new self();
        $order->seller_id = $seller_id;
        $order->buyer_id = $buyer_id;
        $order->service_id = $service_id;
        $order->quantity = $quantity;
        $order->price = $price;
        $order->total = $order->getCountTotal();
        $order->created_at = time();
        return $order;
    }

    /**
     * @return float
     */
    public function getCountTotal()
    {
        return $this->quantity * $this->price;
    }

    /**
     * @return string
     */
    public function getDate()
    {
        return Yii::$app->formatter->asDate($this->created_at, 'd.M.Y');
    }

    /**
     * @return string
     */
    public function getPrice()
    {
        return Yii::$app->formatter->asDecimal($this->price, 2);
    }

    /**
     * @return string
     */
    public function getTotalPrice()
    {
        return Yii::$app->formatter->asDecimal($this->total, 2);
    }

    /**
     * Сумма прописью
     * @return string
     */
    public function getTotalPrice2String()
    {
        return OrderService::num2str($this->total);
    }
}
