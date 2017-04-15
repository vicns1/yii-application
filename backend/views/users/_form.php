<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use common\models\Role;
use common\models\User;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
$q=(new \yii\db\Query())->select(['name', 'description'])->from('auth_item')->all();
$roles =ArrayHelper::map($q, 'name', 'description');
foreach ($roles as $key=>&$value) { $value =$key.' - '.$value;}
?>

<div class="user-record-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($user, 'username')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($user, 'email')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($role, 'item_name')->dropDownList($roles, ['prompt'=>'Select role']) ?>

    <div class="form-group">
        <?= Html::submitButton($user->isNewRecord ? 'Create' : 'Update', ['class' => $user->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
