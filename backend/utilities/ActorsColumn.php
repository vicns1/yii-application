<?php
namespace backend\utilities;

use common\models\film\Film;
use yii\base\Model;
use yii\grid\DataColumn;
use yii\helpers\Html;

class ActorsColumn extends DataColumn
{
    public function init()
    {
        $this->label = $this->label ?: 'Actors';
        $this->content = [$this, 'makeActorsCellContent'];
//        AuditColumnAssetsBundle::register($this->grid->view);
    }

    protected function makeActorsCellContent($model)
    {
        return $this->makeActorsPopoverElement($this->getActorsValues($model));

    }


    protected function makeActorsPopoverElement($values)
    {
        return Html::tag(
            'span',
            '',
            [
                'class' => 'actor-toggler glyphicon glyphicon-list',
                'data-toggle' => 'popover',
                'data-html' => 'true',
                'data-title' => 'Actors',
                'data-trigger' => 'hover',
                'data-content' => $values,
                'placement' => 'left',
            ]
        );
    }


    protected function getActorsValues($model)
    {
         $result = '';
         foreach ($model->actors as $actor) {
           $result .= Html::tag('div', $actor->first_name." ". $actor->last_name ."\n");
         }
        return $result; 
    }

}
