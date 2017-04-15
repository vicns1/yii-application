<?php

namespace backend\controllers;

use Yii;
use common\models\film\film;
use backend\models\FilmForm;
use common\models\film\filmsearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FilmController implements the CRUD actions for film model.
 */
class FilmController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all film models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new filmsearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single film model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new film model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new FilmForm();
        $model->film = new Film;
        $model->film->loadDefaultValues();
        $model->film->setAttributes(Yii::$app->request->post());
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->film->film_id]);
        } 
        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing film model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
public function actionUpdate($id)
    {
        $model = new FilmForm();
        $model->film = $this->findModel($id);
        $model->film->setAttributes(Yii::$app->request->post());
        Yii::warning('-------------------', var_export($model->actors[0], true));
      if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['update', 'id' => $model->film->film_id]);
        } 
        return $this->render('update', ['model' => $model]);
    }
    

    /**
     * Deletes an existing film model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if($model) {
            foreach ($model->actors as $actor)  unlink('actors', $actor, $delete=true);            
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the film model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return film the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = film::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page(model=Film) does not exist.');
        }
    }
}
