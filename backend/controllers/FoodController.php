<?php
/**
 * Created by PhpStorm.
 * User: b_ml_
 * Date: 08/12/2017
 * Time: 19:35
 */

namespace backend\controllers;


use backend\models\CreateForm;
use common\models\Alimentos;
use common\models\AlimentoApi;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class FoodController extends Controller
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
                'only' => ['index', 'create', 'update', 'delete', 'searchtitle'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['delete'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                    [
                        'actions' => ['searchtitle'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $modelData = Alimentos::find()->where(['id_alimento_user' => null])->all();

        return $this->render('index', ['data' => $modelData]);
    }

    public function actionCreate()
    {
        /*$data = new Alimentos();

        $countIdAPI = AlimentoApi::find()->count();

        if ($data->load(Yii::$app->request->post())) {

            if($countIdAPI == 0)
            {
                $alimentoApi = new AlimentoApi();
                $alimentoApi->id_api = 1;
                $alimentoApi->save(false);

                $data->id_api = 1;
            }
            else
            {
                $maxIdAPI = AlimentoApi::find()->max('id_api');

                $maxIdAPI = $maxIdAPI + 1;

                $alimentoApi = new AlimentoApi();
                $alimentoApi->id_api = $maxIdAPI;
                $alimentoApi->save(false);


                $data->id_api = $maxIdAPI;
            }

            $data->save();

            return $this->redirect(['index']);
        } else {

            return $this->renderAjax('create', [
                'data' => $data,
            ]);
        }*/



        /*$data = new CreateForm();
        if ($data->load(Yii::$app->request->post())) {
            return $this->redirect(['index']);
        }

        return $this->renderAjax('create', [
            'data' => $data,
        ]);*/



        $data = new CreateForm();
        if ($data->load(Yii::$app->request->post())) {
            if ($data->create()) {
                return $this->redirect(['index']);
            }
        }

        return $this->renderAjax('create', [
            'data' => $data,
        ]);
    }

    public function actionUpdate($type, $id)
    {
        $data = Tips::find()->where(['id' => $id])->one();

        if ($data->load(Yii::$app->request->post()) && $data->save()) {
            return $this->redirect(['index', 'type' => $type]);
        } else {
            return $this->renderAjax('update', [
                'data' => $data,
            ]);
        }
    }

    public function actionDelete($response, $type, $id)
    {
        if($id != null && $response == null)
        {
            echo $this->renderAjax('DeletePopUp', ['id' => $id, 'type' => $type]);

        }else {if ($id != null && $response != null) {
            if ($response == "yes") {

                $tips = Tips::find()->where(['id' => $id])->one();

                $tips->delete();

                return $this->redirect(['index', 'type' => $type]);
            } else {
                return $this->redirect(['index', 'type' => $type]);
            }
        } else {
            return $this->redirect(['index', 'type' => $type]);
        }
        }
    }

    public function actionSearchtitle($testsearch, $type){

        $tipschannel =  TipsChannel::find()->where(['channel' => $type])->one();

        $find_result = Tips::find()->where(['id_channel' => $tipschannel->id],['like', 'id', $testsearch])->all();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $find_result;
    }

}