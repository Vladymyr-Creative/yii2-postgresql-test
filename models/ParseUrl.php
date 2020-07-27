<?php

namespace app\models;

use Yii;
use Exception;
use \yii\db\Query;
use app\models\Parser;

class ParseUrl
{
    const STATUS_WAITING = "waiting";
    const STATUS_IN_PROGRESS = "in progress";
    const STATUS_DONE = "done";

    private $urlId = null;

    private function changeStatusTo($status)
    {
        $urlId = $this->getUrlId();
        if (empty($urlId)) {
            return;
        }
        Yii::$app->db->createCommand("UPDATE page SET status='$status' WHERE id='$urlId'")
            ->execute();
    }

    private function makeUrlDone()
    {
       $this->changeStatusTo(self::STATUS_DONE);
    }

    public function getUrl()
    {
        $key = ['id', 'link', 'status'];
        $table = Parser::PAGE_TABLE;
        $url = (new Query())
            ->select($key)
            ->from($table)
            ->where('status=:status', [':status' => self::STATUS_WAITING])
            ->one();

        if (empty($url)) {
            return null;
        }

        $this->setUrlId($url["id"]);
        $this->changeStatusTo(self::STATUS_IN_PROGRESS);
        return $url['link'];
    }

    public function getUrlId()
    {
        return $this->urlId;
    }

    public function setUrlId($urlId)
    {
        $this->urlId = $urlId;
    }
}