<?php

namespace app\controllers\parser;

use app\models\Parser;
use yii\web\Controller;
use app\models\Collect;
use app\models\ParseUrl;

class ParserController extends Controller
{
    private $parseUrl = null;

    public function actionIndex()
    {
        echo __METHOD__;
    }

    public function actionCollect()
    {
        $this->parseUrl = new ParseUrl();
        $urlData = $this->getUrlDataForParse();
        $collection = new Collect();
        $result = $collection->getPage($urlData['link']);
        if (!empty($result)) {
            $this->recordData($result);
            $this->parseUrl->makeUrlDone($urlData['id']);
        }
    }

    public function recordData($data)
    {
        Parser::handleData($data);
    }

    private function getUrlDataForParse()
    {
        $urlData = $this->parseUrl->getUrlData();
        if (empty($urlData)) {
            return null;
        }
        $this->parseUrl->makeUrlInprogres($urlData['id']);
        return $urlData;
    }
}