<?php

namespace app\modules\order\services;

use app\modules\order\entities\OrderBuyer;
use app\modules\order\entities\OrderOrder;
use app\modules\order\repositories\OrderBuyerRepository;
use app\modules\order\repositories\OrderOrderRepository;
use app\modules\order\repositories\OrderSellerRepository;
use app\modules\order\repositories\OrderParamRepository;

class OrderService
{
    private $orderBuyerRepository;
    private $orderOrderRepository;
    private $orderSellerRepository;
    private $orderParamRepository;
    private $transactionManager;

    public function __construct(
        OrderBuyerRepository $orderBuyerRepository,
        OrderOrderRepository $orderOrderRepository,
        OrderSellerRepository $orderSellerRepository,
        OrderParamRepository $orderParamRepository,
        TransactionManager $transactionManager
    )
    {
        $this->orderBuyerRepository = $orderBuyerRepository;
        $this->orderOrderRepository = $orderOrderRepository;
        $this->orderSellerRepository = $orderSellerRepository;
        $this->orderParamRepository = $orderParamRepository;
        $this->transactionManager = $transactionManager;
    }

    /**
     * Создаём транзакцию по созданию покупателя и счёта
     *
     * @param $name
     * @param $address
     * @param $inn
     * @param $kpp
     * @param $checking_ac
     * @param $corresp_ac
     * @param $bik
     * @param $bank
     * @param $seller_id
     * @param $service_id
     * @param $quantity
     * @param $price
     * @return OrderOrder
     * @throws \Exception
     */
    public function create(
         $name,
         $address,
         $inn,
         $kpp,
         $checking_ac,
         $corresp_ac,
         $bik,
         $bank,
         $seller_id,
         $service_id,
         $quantity,
         $price
    ) {
        $transaction = $this->transactionManager->begin();
        try {
            $buyer = self::createBuyer($name, $address, $inn, $kpp, $checking_ac, $corresp_ac, $bik, $bank);
            $order = self::createOrder($seller_id, $buyer->id, $service_id, $quantity, $price);

            $transaction->commit();
        } catch (\Exception $e) {
            $transaction->rollBack();
            throw $e;
        }
        return $order;
    }

    /**
     * Создаём покупателя
     *
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
    public function createBuyer($name, $address, $inn, $kpp, $checking_ac, $corresp_ac, $bik, $bank)
    {
        $buyer = OrderBuyer::create($name, $address, $inn, $kpp, $checking_ac, $corresp_ac, $bik, $bank);
        return $this->orderBuyerRepository->add($buyer);
    }

    /**
     * Создаём счёт
     *
     * @param $seller_id
     * @param $buyer_id
     * @param $service_id
     * @param $quantity
     * @param $price
     * @return OrderOrder
     */
    public function createOrder($seller_id, $buyer_id, $service_id, $quantity, $price)
    {
        $order = OrderOrder::create($seller_id, $buyer_id, $service_id, $quantity, $price);
        return $this->orderOrderRepository->add($order);
    }

    /**
     * Возвращает сумму прописью
     *
     * @author runcore
     * @uses morph(...)
     * @param $num
     * @return string
     */
    public static function num2str($num)
    {
        $nul = 'ноль';
        $ten = [
            ['','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'],
            ['','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'],
        ];
        $a20 = ['десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать'];
        $tens = [2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто'];
        $hundred = ['','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот'];
        $unit = [ // Units
            ['копейка' ,'копейки' ,'копеек',    1],
            ['рубль'   ,'рубля'   ,'рублей'    ,0],
            ['тысяча'  ,'тысячи'  ,'тысяч'     ,1],
            ['миллион' ,'миллиона','миллионов' ,0],
            ['миллиард','милиарда','миллиардов',0],
        ];

        list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
        $out = [];
        if (intval($rub) > 0) {
            foreach (str_split($rub, 3) as $uk => $v) { // by 3 symbols
                if (!intval($v)) continue;

                $uk = sizeof($unit) - $uk - 1; // unit key
                $gender = $unit[$uk][3];
                list($i1, $i2, $i3) = array_map('intval', str_split($v, 1));

                // mega-logic
                $out[] = $hundred[$i1]; # 1xx-9xx
                if ($i2 > 1) $out[] = $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
                else $out[] = $i2 > 0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9

                // units without rub & kop
                if ($uk > 1) $out[] = self::morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
            }
        } else {
            $out[] = $nul;
        }
        $out[] = self::morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
        $out[] = $kop.' '.self::morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop

        $out = trim(preg_replace('/ {2,}/', ' ', join(' ', $out)));

        $char = mb_strtoupper(substr($out, 0, 2), "utf-8");
        $out[0] = $char[0];
        $out[1] = $char[1];

        return $out;
    }

    /**
     * Склоняем словоформу
     *
     * @ author runcore
     * @param $n
     * @param $f1
     * @param $f2
     * @param $f5
     * @return mixed
     */
    public static function morph($n, $f1, $f2, $f5)
    {
        $n = abs(intval($n)) % 100;
        if ($n > 10 && $n < 20) return $f5;
        $n = $n % 10;
        if ($n > 1 && $n < 5) return $f2;
        if ($n == 1) return $f1;
        return $f5;
    }
}
