<?php

namespace backend\controllers;

use common\models\Auth;
use common\models\AuthAssignment;
use common\models\Complemento;
use backend\models\EdituserForm;
use Yii;
use common\models\User;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;


/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
                    'delete' => ['POST','GET'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'searchmail', 'delete'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['view'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['searchmail'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        /*$searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);*/

        $modelData = user::find()->all();

        return $this->render('index', ['data' => $modelData]);

    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $update, $role)
    {
        if($update == 'yes'){

            $model = User::findOne(['id' => $id]);

            $auth = AuthAssignment::findOne(['user_id' => $id]);

            if($role == 'admin'){
                $auth->item_name = 'user';
            } else {
                $auth->item_name = 'admin';
            }
            $auth->save(false);

            /*echo "<script type=\"text/javascript\">";
            echo "$(\"#modal_view\").modal('hide')";
            echo "</script>";*/

            return $this->renderAjax('view', [
                'model' => $model,
            ]);

        } else {
            return $this->renderAjax('view', [
                'model' => User::findOne(['id' => $id]),
            ]);
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();



        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $model_edit = new EdituserForm();

        /*if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect('../../web/');
                }
            }
        }*/

        if ($model_edit->load(Yii::$app->request->post())) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model_edit,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @param $pois
     * @return mixed
     * @internal param string $responseBoolean
     */
    public function actionDelete($id, $response)
    {
        if($id != null && $response == null)
        {
            echo $this->renderAjax('DeletePopUp', ['id' => $id]);

        }else {if ($id != null && $response != null) {
                if ($response == "yes") {
                    $ComplementoUser = Complemento::find()->where(['id_user' => $id])->one();

                    $ComplementoUser->delete();

                    $auth = AuthAssignment::find()->where(['user_id' => $id])->one();

                    $auth->delete();

                    $this->findModel($id)->delete();

                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            } else {
                return $this->redirect(['index']);
            }
        }

    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionSearchmail($como, $testsearch){

        switch ($como) {
            case "ID":
                $find_result = User::find()->where(['like', 'id', $testsearch])->all();
                break;
            case "Username":
                $find_result = User::find()->where(['like', 'username', $testsearch])->all();
                break;
            case 'Email':
                $find_result = User::find()->where(['like', 'email', $testsearch])->all();
                break;
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $find_result;
    }
}
