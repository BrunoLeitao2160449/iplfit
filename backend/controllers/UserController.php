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

class UserController extends Controller
{

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

    public function actionIndex()
    {
        $modelData = user::find()->all();

        return $this->render('index', ['data' => $modelData]);

    }

    public function actionView($update, $role, $id)
    {
        if($update == 'yes'){

            $model = User::findOne(['id' => $id]);

            $auth = AuthAssignment::findOne(['user_id' => $id]);

            if($role == 'admin'){
                $auth->item_name = 'user';
            }

            if($role == 'user'){
                $auth->item_name = 'admin';
            }
            $auth->save(false);

            return $this->renderAjax('view', [
                'model' => $model,
            ]);

        } else {
            return $this->renderAjax('view', [
                'model' => User::findOne(['id' => $id]),
            ]);
        }
    }

    /*public function actionUpdate($id)
    {
        $model_edit = new EdituserForm();

        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->redirect('../../web/');
                }
            }
        }

        if ($model_edit->load(Yii::$app->request->post())) {
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('update', [
                'model' => $model_edit,
            ]);
        }
    }*/


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

                    //$this->findModel($id)->delete();

                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            } else {
                return $this->redirect(['index']);
            }
        }

    }

    /*protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }*/

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
