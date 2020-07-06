<?php

namespace app\models;

use yii\base\Component;
use yii\httpclient\Client;
use yii\httpclient\Request;
use yii\httpclient\Response;
use Yii;
use Exception;
use keltstr\simplehtmldom\SimpleHTMLDom;

class Collect extends Component
{

    const DEFAULT_URL = "https://www.foetex.dk/dsgsearchservice/rest/apps/foetexdk/searchers/products?q=*&page=";

    public $lastResponce;
    public $client;
    public $lastRequest;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        parent::init();
        $this->client = new Client([
            'transport' => 'yii\httpclient\CurlTransport',
            'baseUrl' => self::DEFAULT_URL,
        ]);
    }

    public function getPage($url = '')
    {
        if (empty($url)) {
            $url = self::DEFAULT_URL;
        }

        try {
            $request = $this->client->get($url);
            $this->lastResponce = $request->send();
            $body = $this->lastResponce->content;
            return json_decode($body);

        } catch (Exception $e) {
            echo $e->getMessage() . "" . $e->getCode() . "" . $e->getLine() . "" . $e->getFile();
        }
    }
}
