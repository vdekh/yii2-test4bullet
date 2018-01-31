<?php

namespace app\modules\order\controllers;

use app\modules\order\search\OrderOrderSearch;
use app\modules\order\forms\OrderCreateForm;
use app\modules\order\repositories\OrderOrderRepository;
use app\modules\order\services\OrderService;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `order` module
 */
class DefaultController extends Controller
{
    private $orderOrderRepository;
    private $orderService;

    /**
     * DefaultController constructor.
     * @param int $id
     * @param \yii\base\Module $module
     * @param OrderOrderRepository $orderOrderRepository
     * @param OrderService $orderService
     * @param array $config
     */
    public function __construct(
        $id,
        $module,
        OrderOrderRepository $orderOrderRepository,
        OrderService $orderService,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->orderOrderRepository = $orderOrderRepository;
        $this->orderService = $orderService;
    }

    /**
     * Выводим все счета
     *
     * @return string
     */
    public function actionList()
    {
        $searchModel = new OrderOrderSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->get());

        return $this->render('list', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Выводим покупателю форму
     *
     * @return string
     */
    public function actionForm()
    {
        $form = new OrderCreateForm();
        $form->defaultValues();

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $model = $this->orderService->create(
                $form->name,
                $form->address,
                $form->inn,
                $form->kpp,
                $form->checking_ac,
                $form->corresp_ac,
                $form->bik,
                $form->bank,
                $form->seller_id,
                $form->service_id,
                $form->quantity,
                $form->price
            );
            return $this->redirect(['/order/default/generation', 'id'=>$model->id]);
        }
        return $this->render('form', [
            'orderForm' => $form,
        ]);
    }

    /**
     * Генерируем покупателю счёт
     *
     * @param $id
     * @return string
     */
    public function actionGeneration($id)
    {
        $order = $this->orderOrderRepository->find($id);
        /**
         * Либо один общий запрос:
         *
         * SELECT * FROM order_order as t1 JOIN order_service as t2 JOIN order_seller as t3 JOIN order_buyer as t4
         * ON t1.service_id = t2.id AND t1.seller_id = t3.id AND t1.buyer_id = t4.id
         * WHERE t1.id = :id
         *
         * :id => (int)$id
         *
         * Но надо развести столбцы с одинаковыми названиями
         */
        return $this->render('generation', [
            'order' => $order,
        ]);
    }
}
