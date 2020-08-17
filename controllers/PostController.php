<?php

namespace app\controllers;

use app\models\RegisterForm;
use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Post;

class PostController extends Controller
{
    public function actionIndex()
    {
//        $posts = Post::find()->all();
//        return $this->render('index', [
//            'posts'=> $posts
//        ]);
//OR
//        return $this->render('index', compact('posts'));


        $query = Post::find()->with('category');
        $countQuery = clone $query;
        $pages = new Pagination([
            'pageSize' => 3,
            'totalCount' => $countQuery->count(),
            'pageSizeParam' => false,
            'forcePageParam' => false,
        ]);

        $posts = $query->orderBy('title')
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();

        return $this->render('index', [
            'posts' => $posts,
            'pagination' => $pages,
        ]);
    }

    public function actionView($id)
    {
        var_dump($id);
        die;
    }

    public function actionRegister()
    {
//        if (!Yii::$app->user->isGuest) {
//            return $this->goHome();
//        }

        $model = new RegisterForm();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
//            return $this->goBack();
//        }

        $model->password = '';
        return $this->render('register', [
            'model' => $model,
        ]);
    }

}
