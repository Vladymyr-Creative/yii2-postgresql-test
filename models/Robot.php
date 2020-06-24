<?php

namespace app\models;

use yii\base\Component;
use yii\httpclient\Client;
use yii\httpclient\Request;
use yii\httpclient\Response;
use Yii;
use Exception;
use keltstr\simplehtmldom\SimpleHTMLDom;

class Robot extends Component {

    const DEFAULT_URL = "https://wizzair.com/";

    public $lastResponce;
    public $client;
    public $lastRequest;

    public function __construct() {
        $this->init();
    }

    public function init() {
        parent::init();
        $this->client = new Client([
            'transport' => 'yii\httpclient\CurlTransport',
            'baseUrl' => self::DEFAULT_URL,
        ]);
    }

    public function getPage($url = '') {
        if (empty($url)) {
            $url = self::DEFAULT_URL;
        }

        try {
            $request = $this->client->get($url);
            $this->lastResponce = $request->send();

            $html = SimpleHTMLDom::str_get_html($this->lastResponce->content);
            foreach($html->find('img') as $element){
                echo $element->src . '<br>';
            }
        } catch (Exception $e) {
            echo $e->getMessage() . "" . $e->getCode() . "" . $e->getLine() . "" . $e->getFile();
        }
    }
}
