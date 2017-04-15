<?php
namespace backend\models;
use common\models\film\Film;
use common\models\film\Actor;
use Yii;
use yii\base\Model;
use yii\bootstrap\ActiveForm;

class FilmForm extends Model
{
	private $_film;
	private $_actors;

	public function  rules()
	{
		return [
		[['Film'],'required'],
		[['Actors'],'safe'],
		];
	}
	public function afterValidate()
	{
		if(!Model::validateMultiply($this->getAllModels())) {
			$this ->addError(null); // to prevent saving
		}
		parent::afterValidate();
	}
	public function save()
	{
		if (!$this->validaete()) return false;
		$transaction = Yii::$app->db->beginTransaction();
		if(!$this->film->save()) {
			$transaction->rollBack();
            return false;
        }
		if(!$this->saveActors()) {
			$transaction->rollBack();
            return false;
        }
        $transaction->commit();
        return true;
	}
	public function saveActors()
	{
		$notdel = [];
		$query = Film::find()->where(['film_id'=>$this->film_id])->with('film_actors') ->all();
		foreach ($query as $id => $actor) {
			if(!isset($this->actors['id'])) $this->unlink('Actors',$query['id']);
		}
		foreach ($this->actors as $id=>$actor) {
            if(!isset($query[$id])) $thid->link('Actors', $actor);
            if(!$actor->save(false)) return false; 
		}
		return true;
	}
	public function getFilm()
	{
		return $this->_film;
	}
    public function setFilm($film)
    {
    	if($film instanceof Film) $this->_film = $film;
    	else if (is_array($film)) $this->_film->setAttributes($film);
    }
    public function getActors()
    {
    	if($this->_actors===null)  $this->_actors = $this->film->isNewRecord ? []: $this->film->actors;
    	return $this->_actors;
    }
    public function getActor($key)
    {
    	$actor = ($key && strpos($key, 'new') === false) ? $this->film->getActor($key): new Actor(LoadDefaultValues());
    	return $actor;
    }
    public function setActors($actors)
    {
    	unset($actors['__id__']);
        $this->_actors = [];
        foreach ($actors as $key => $value) {
        	if(is_array($value)) {
        		$this->_actors[$key] = $this->getActor($key);
        		$this->_actors[$key]->setAttributes($value);
        	}
        	else if($value instanceof Actor) $this-> _actors[$value->actor_id] = $value;
        }
    } 
    public function errorSummary($form)
    {
        $errorLists = [];
        foreach ($this->getAllModels() as $id => $model) {
          	$errorList = $form->errorSummary($model,[
          	'header' => '<p>Please fix the following errors for<b> '.$id.'</b></p>']);
          	$errorList =str_replace ('<li></li>',  '',  $errorList); // for empty errors
            $errorLists[] = $errorList;
          }  
          return implode('', $errorLists);
    }
    private function getAllModels()
    {
    	$models =['Film'=>$this->film];
     	foreach ($this->actors as $actor) 
    		$models['Actor.'.$actor->actor_id] = $actor;
    	return $models;
    }
}
?>