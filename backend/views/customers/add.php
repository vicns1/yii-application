<?php
use backend\models\customer\CustomerRecord;
use backend\models\customer\PhoneRecord;
use yii\web\View;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * Add Customer UI.
 *
 * @var View $this
 * @var CustomerRecord $customer
 * @var PhoneRecord $phone
 */

$form = ActiveForm::begin([
    'id' => 'add-customer-form',
]);

echo $form->errorSummary([$customer, $phone]);
echo $form->field($customer, 'first_name');
echo $form->field($customer, 'create_date');
echo $form->field($customer, 'last_name');

echo $form->field($phone, 'number');

echo Html::submitButton('Submit', ['class' => 'btn btn-primary']);
ActiveForm::end();
