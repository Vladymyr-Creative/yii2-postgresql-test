<?php

namespace app\models;

use Yii;
use Exception;
use \yii\db\Query;
use app\models\Parser;

class ParseUrl
{
    public function getUrl()
    {
        $key = ['id', 'link', 'status'];
        $status = 'waiting';
        $table = Parser::PAGE_TABLE;
        $url = (new Query())
            ->select($key)
            ->from($table)
            ->where('status=:status', [':status' => $status])
            ->all();

        if (empty($url)) {
            return null;
        }

        self::changeStatusTo();
        echo "<pre>";
        print_r(current($url)['link']);
        echo "</pre>";
        die();
        return current($url)['link'];
    }
}