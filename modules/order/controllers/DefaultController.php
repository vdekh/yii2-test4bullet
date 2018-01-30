<?php

namespace app\modules\order\controllers;

use yii\web\Controller;

/**
 * Default controller for the `order` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionAdd()
    {
        return $this->render('add');
    }
}
