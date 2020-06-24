<?php

namespace app\controllers\admin;

use yii\web\Controller;

class MyController extends Controller
{
    public $defaultAction = 'test';
    
    public function actionIndex() {
        return "admin";
    }

    public function actionTest() {
        $sdf = "dssf" . 12;
        return $sdf;
    }
}
