<?php

namespace app\controllers\parser;

use app\models\Page;
use yii\web\Controller;
use app\models\Collect;

class ParseController extends Controller {

    public function actionIndex() {
        echo __METHOD__;
    }

    public function actionCollect($url = '') {
        $collection = new Collect();
        $result = $collection->getPage($url);
        if (!empty($result)) {
            $this->recordData($result);
        }
    }

    public function recordData($data) {
        Page::handleData($data);
    }
}
