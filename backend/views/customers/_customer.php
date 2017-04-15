<?php
/**
 * @var Customer $model
 */
use backend\models\customer\Customer;

echo \yii\widgets\DetailView::widget(
    [
        'model' => $model,
        'attributes' => [
            ['attribute' => 'first_name'],
            ['attribute' => 'last_name'],
            ['attribute' => 'create_date', 'value' => $model->create_date->format('YYYY-mm-dd')],
            'last_name:text',
            ['label' => 'Phone Number', 'attribute' => 'phones.0.number']
        ]
    ]);
