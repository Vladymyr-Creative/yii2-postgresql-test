<?php

namespace app\models;

use yii\base\Component;
use Yii;
use Exception;
use \yii\db\Query;
use app\models\Parser;

class ParseUrl extends Component
{
    const STATUS_WAITING = "waiting";
    const STATUS_IN_PROGRESS = "in progress";
    const STATUS_DONE = "done";

    public function changeStatusTo($id,$status)
    {
        if (empty($id)) {
            return;
        }
        Yii::$app->db->createCommand("UPDATE page SET status='$status' WHERE id='$id'")
            ->execute();
    }

    public function makeUrlDone($id)
    {
       $this->changeStatusTo($id, self::STATUS_DONE);
    }

    public function makeUrlInprogres($id)
    {
        $this->changeStatusTo($id, self::STATUS_IN_PROGRESS);
    }

    public function getUrlData()
    {
        $keys = ['id', 'link', 'status'];
        $table = Parser::PAGE_TABLE;
        $urlData = (new Query())
            ->select($keys)
            ->from($table)
            ->where('status=:status', [':status' => self::STATUS_WAITING])
            ->one();

        if (empty($urlData)) {
            return null;
        }
        return $urlData;
    }
}