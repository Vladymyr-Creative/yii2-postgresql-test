<?php

namespace app\controllers;

use app\models\RegisterForm;
use Yii;
use yii\db\Query;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Post;
use app\models\User;
use yii\web\UploadedFile;
use yii\widgets\Pjax;

class PostController extends Controller
{
    public function actionIndex()
    {
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
        phpinfo();
        die;
    }

    public function actionSubmit()
    {
        return "ajax";
    }


    public function actionTesting()
    {
        $query = new Query();
        $query->select('*')
            ->from('post')
            ->leftJoin('product', 'post.id=product.id');
        $command = $query->createCommand();
        $response = $command->queryAll();
        return $this->render('testing', [
            'response' => $response
        ]);
    }

    public function actionRegister()
    {
        $model = new RegisterForm;
        $idUser = 2;//Yii::$app->request->get()['id'] ? Yii::$app->request->get()['id']: 1;
        $user = User::find()->where(['id' => $idUser])->one();
//        if ($model->load(Yii::$app->request->post()) && $model->login()) {
        var_dump(Yii::$app->request->isPost);
        echo "<br>";
        var_dump(Yii::$app->request->post());
        echo "<br>";
        var_dump($model->load(Yii::$app->request->post()));
        echo "<br>";
        var_dump($model->validate());
//        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
//            die('wewew');
//            Yii::$app->request->post()['User']['email'] ? $user->email = Yii::$app->request->post()['User']['email'] : '';
//            Yii::$app->request->post()['User']['username'] ? $user->username = Yii::$app->request->post()['User']['username'] : '';
//            Yii::$app->request->post()['User']['surname'] ? $user->surname = Yii::$app->request->post()['User']['surname'] : '';
//            $user->save();
//
//            ($_FILES['User']['name']['avatar'] ? $user->avatar = UploadedFile::getInstance($user, 'avatar') : '');
//            if ($user->avatar && $user->validate()) {
//                return;
//            }
//            Yii::$app->getResponse()->redirect(Yii::$app->getRequest()->getUrl());
//        }
        $userInfo = User::find()->where(['id' => $idUser])->one();
        return $this->render('register', [
            'userInfo' => $userInfo
        ]);
    }

}
