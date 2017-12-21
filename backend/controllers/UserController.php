<?php

namespace backend\controllers;

use common\models\Alimentos;
use common\models\AuthAssignment;
use common\models\Complemento;
use common\models\DiaUtilizador;
use common\models\Mosquitto;
use common\models\RefeicaoDia;
use Yii;
use common\models\User;
use yii\db\Exception;
use yii\web\Controller;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use common\models\Tips;

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


    public function actionDelete($id, $response)
    {
        if($id != null && $response == null)
        {
            echo $this->renderAjax('DeletePopUp', ['id' => $id]);

        }else {if ($id != null && $response != null) {
                if ($response == "yes") {

                    do {
                        $refeicao_dia = RefeicaoDia::find()
                            ->leftJoin('alimentos', '`alimentos`.`id` = `refeicao_dia`.`id_alimento`')
                            ->leftJoin('complemento_user', '`complemento_user`.`id_user` = `alimentos`.`id_alimento_user`')
                            ->where(['`complemento_user`.`id_user`' => $id])->one();

                        if (count($refeicao_dia) != 0) {
                            $refeicao_dia->delete();
                        }

                        $Alimentos = Alimentos::find()->where(['id_alimento_user' => $id])->one();

                        if (count($Alimentos) != 0) {
                            $Alimentos->delete();
                        }

                        $diautilizador = DiaUtilizador::find()->where(['id_user' => $id])->one();

                        if (count($diautilizador) != 0) {
                            $diautilizador->delete();
                        }
                    }while(count($diautilizador) != 0 || count($Alimentos) != 0 || count($refeicao_dia) != 0);

                    $ComplementoUser = Complemento::find()->where(['id_user' => $id])->one();

                    $ComplementoUser->delete();

                    $auth = AuthAssignment::find()->where(['user_id' => $id])->one();

                    $auth->delete();

                    $user = User::find()->where(['id' => $id])->one();

                    $user->delete();

                    return $this->redirect(['index']);
                } else {
                    return $this->redirect(['index']);
                }
            } else {
                return $this->redirect(['index']);
            }
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



    public function FazPublish($canal,$msg)
    {
        $server = "5.196.27.244";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "yii";
        $mqtt = new Mosquitto();
        $mqtt->address = $server;
        $mqtt->port = $port;
        $mqtt->clientid = $client_id;
        if ($mqtt->connect(true, NULL, $username, $password))
        {
            $mqtt->publish($canal, $msg, 0);
            $mqtt->close();
        }
        else { file_put_contents("debug.output","Time out!"); }
    }
}
