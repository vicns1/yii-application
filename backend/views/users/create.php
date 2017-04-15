<?php

use yii\helpers\Html;
use common\models\User;
use common\models\Role;


/* @var $this yii\web\View */
/* @var $model common\models\user\User */

$this->title = 'Create User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-record-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'user' => $user,
        'role' => $role,
    ]) ?>

</div>
