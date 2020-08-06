<?php

namespace app\controllers;

use app\models\Post;
use yii\console\Controller;
class PostController extends Controller
{
    public function actionIndex()
    {
        $posts = Post::find()->select(['code', 'name', 'population'])->limit(2)->all();
//        return $this->render('index', [
//            'posts'=> $posts
//        ]);

        return $this->render('index', compact('posts'));
    }
}
