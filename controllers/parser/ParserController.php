<?php

namespace app\controllers\parser;

use app\models\Parser;
use yii\web\Controller;
use app\models\Collect;
use app\models\ParseUrl;

class ParserController extends Controller {

    public function actionIndex() {
        echo __METHOD__;
    }

    public function actionCollect() {
        $url = $this->getUrlForParse();
        $collection = new Collect();
        $result = $collection->getPage($url);
        if (!empty($result)) {
            $this->recordData($result);
        }
    }

    public function recordData($data) {
        Parser::handleData($data);
    }

    private function getUrlForParse()
    {
        return ParseUrl::getUrl();
    }
}
