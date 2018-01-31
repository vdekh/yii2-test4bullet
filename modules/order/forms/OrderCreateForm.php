<?php

namespace app\modules\order\forms;

use app\modules\order\entities\OrderBuyer;
use app\modules\order\entities\OrderOrder;
use yii\base\Model;

/**
 * Форма добавляет нового покупателя и цену товара
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
 * @property int $seller_id
 * @property int $service_id
 * @property int $quantity
 * @property float $price
 * @property OrderBuyer|null $buyer
 * @property OrderOrder|null $order
 */
class OrderCreateForm extends Model
{
    public $name;
    public $address;
    public $inn;
    public $kpp;
    public $checking_ac;
    public $corresp_ac;
    public $bik;
    public $bank;

    private $buyer;

    public $seller_id;
    public $service_id;
    public $quantity;
    public $price;

    private $order;

    /**
     * OrderCreateForm constructor.
     * @param OrderBuyer|null $buyer
     * @param OrderOrder|null $order
     * @param array $config
     */
    public function __construct(OrderBuyer $buyer = null, OrderOrder $order = null, $config = [])
    {
        $this->buyer = $buyer;
        $this->order = $order;
        parent::__construct($config);
    }

    public function init()
    {
        if ($this->buyer) {
            $this->name = $this->buyer->name;
            $this->address = $this->buyer->address;
            $this->inn = $this->buyer->inn;
            $this->kpp = $this->buyer->kpp;
            $this->checking_ac = $this->buyer->checking_ac;
            $this->corresp_ac = $this->buyer->corresp_ac;
            $this->bik = $this->buyer->bik;
            $this->bank = $this->buyer->bank;
        }
        if ($this->order) {
            $this->seller_id = $this->order->seller_id;
            $this->service_id = $this->order->service_id;
            $this->quantity = $this->order->quantity;
            $this->price = $this->order->price;
        }
    }

    public function rules()
    {
        return [
            [
                [
                    'name', 'address', 'inn', 'kpp', 'checking_ac', 'corresp_ac', 'bik', 'bank',
                    'seller_id', 'service_id', 'quantity', 'price'
                ],
                'required'
            ],
            [['inn', 'kpp', 'checking_ac', 'corresp_ac', 'bik', 'seller_id', 'service_id', 'quantity', 'price'], 'integer'],
            [['name', 'address', 'bank'], 'string', 'max' => 255],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'address' => 'Адресс',
            'inn' => 'ИНН',
            'kpp' => 'КПП',
            'checking_ac' => 'Расчетный счет',
            'corresp_ac' => 'Кор. счет',
            'bik' => 'БИК',
            'bank' => 'Банк',

            'seller_id' => 'ID продавца',
            'service_id' => 'ID услуги',
            'quantity' => 'Кол-во',
            'price' => 'Цена',
        ];
    }

    /**
     * Дефолтные значения для демонстрации, чтобы сэкономить время и не заполнять форму
     */
    public function defaultValues()
    {
        $this->name = 'ООО "Роммашка"';
        $this->address = 'Санкт-Петербург, пр. Невский, д. 51, оф. 15';
        $this->inn = '987654321';
        $this->kpp = '987123456';
        $this->checking_ac = '9223372036854775807';
        $this->corresp_ac = '998877665544332211';
        $this->bik = '98765432';
        $this->bank = 'ОАО БАНК "ВТОРОЙ БАНК", Г. САНКТ-ПЕТЕРБУРГ';
        $this->seller_id = 1;
        $this->service_id = 1;
        $this->quantity = 1;
        $this->price = 100000;
    }
}
