<?php

namespace app\controllers;

use yii\web\Controller;
use app\models\Robot;

class ParseController extends Controller {

    public function actionIndex() {
        echo __METHOD__;
    }

    public function actionGetPage($url = '') {
        $robot = new Robot();
        $result = $robot->getPage($url);
    }

}
