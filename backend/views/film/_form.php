<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\bootstrap\ActiveForm;
use common\models\film\Language;
use common\models\film\Category;

/* @var $this yii\web\View */
/* @var $model common\models\film\film */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
<div class="col-md-6 film-form">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal','encodeErrorSummary' => true, 'enableClientValidation' => false, 'fieldConfig'=>
    ['template' => '{label}<div class="col-sm-7">{input}</div>',
      'horizontalCssClasses' =>['label' => 'col-sm-4'] 
       ],]); ?>

    <?=$model->errorSummary($form) ?> 
    
    <?= $form->field($model->film, 'title')->textInput() ?>

    <?= $form->field($model->film, 'description')->textarea(['rows' => 4]) ?>

    <?= $form->field($model->film, 'release_year')->textInput(['maxlength' => true]) ?>
    <label class="control-label col-sm-4"> Actors </label>
    <div class="col-sm-7" style="margin-bottom: 10px;"> 
    <?= Html::button(' ---------- Update/Create Actors -------------', ['class' =>'btn btn-default']) ?>
    </div>
    <?= $form->field($model->film, 'language_id')->dropDownList([ArrayHelper::
    map(Language::find()->all(),'language_id','name')]) ?>

    <?= $form->field($model->film, 'rental_duration')->textInput() ?>

    <?= $form->field($model->film, 'rental_rate')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->film, 'hmlength')->textInput() ?>

    <?= $form->field($model->film, 'replacement_cost')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->film, 'rating')->dropDownList([ 'G' => 'G', 'PG' => 'PG', 'PG-13' => 'PG-13', 'R' => 'R', 'NC-17' => 'NC-17', ], ['prompt' => '']) ?>

    <?= $form->field($model->film, 'special_features')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model->film, 'last_update')->textInput() ?>

    <?= $form->field($model->film, 'category_id')->dropDownList([ArrayHelper::
     map(Category::find()->all(),'category_id','name')]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->film->isNewRecord ? 'Create' : 'Update', ['class' => $model->film->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
<div class="col-md-6 actors-form" >
    <?= Html::button('New actor <span class="glyphicon gliphicon-plus"></span>', ['class'=>'btn btn-primary pull-right','id'=>'film-new-actor-button']) ?>
    <?php foreach ($model->actors as $key => $actor) {
       echo '<div class="row">'; 
      echo $form->field($actor, 'first_name') ->textInput(['maxlength' => true, 'template' => '<div class="col-sm-6">{input}</div>'])->label(false);
      echo $form->field($actor, 'last_name') ->textInput(['maxlength' => true])->label(false);
      echo '</div>';
    }?>
    <?php ActiveForm::end(); ?>

</div>
</div>