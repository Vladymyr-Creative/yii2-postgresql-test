<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use app\models\User;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = '>Register';
$model=new User;
?>
    <h1>Form</h1>
<?php $form = ActiveForm::begin([
    'id' => 'register-form',
    'options' => [
        'enctype'=>'multipart/form-data',
        'name'=>'form',
        'class'=>'form-register',
    ],
    'layout' => 'horizontal',
    'fieldConfig' => [
        'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
        'labelOptions' => ['class' => 'col-lg-1 control-label '],
    ],
]); ?>

<?= $form->field($model, 'username')->textInput([
    'autofocus' => true,
    'value' => $userInfo->username
]) ?>
<?= $form->field($model, 'email')->textInput(['value' => $userInfo->email]) ?>
<?= $form->field($model, 'surname')->textInput(['value' => $userInfo->surname]) ?>
<?= $form->field($model, 'avatar')->fileInput() ?>
    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Update', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>