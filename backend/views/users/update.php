<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\user\UserRecord */

$this->title = 'Update User: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'role' => $role.
    ]) ?>

</div>
