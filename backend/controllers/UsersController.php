<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\Role;
use common\models\UserSearchModel;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * UsersController implements the CRUD actions for UserRecord model.
 */
class UsersController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'roles' => ['admin'],
                        'allow' => true
                    ]
                ]
            ]
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearchModel();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = new User();
        $role =Role::findOne($user->id); 
        if (!$role)  { $role = new Role();}
        if ($user->load(Yii::$app->request->post()) &&  $role->load(Yii::$app->request->post()) )
       {
             
//             Yii::warning(' Before validate model.', __method__);
         if( $user->validate() && $role->validate()) {
     
            $user->save();
            $role->save();
            return $this->redirect(['view', 'id' => $user->id]);
         }
        } else {
            return $this->render('create', [
                'user' => $user,
                'role'=>$role,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $role = Role::findOne(['user_id' => $user->id]);
        if(!$role) throw new NotFoundHttpException('User role not found!');
        if ($user->load(Yii::$app->request->post()) &&  $role->load(Yii::$app->request->post()) && $user->validate() && $role->validate()) {
            $user->save();
            $role->save();
            return $this->redirect(['view', 'id' => $user->id]);
        } else {
           Yii::warning('********************',\yii\helpers\varDumper::dumpAsString($role, true));
            return $this->render('create', [
                'user' => $user,
                'role'=>$role,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Role::findOne($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the UserRecord model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('USER::The requested page does not exist.');
        }
    }
}
