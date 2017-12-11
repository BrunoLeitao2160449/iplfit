<?php
/**
 * Created by PhpStorm.
 * User: b_ml_
 * Date: 08/12/2017
 * Time: 19:35
 */

namespace backend\controllers;


use backend\models\CreateForm;
use backend\models\EditForm;
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
                'only' => ['index', 'create', 'update', 'delete', 'searchfood'],
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
                        'actions' => ['searchfood'],
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
        $data = new CreateForm();

        if ($data->load(Yii::$app->request->post())) {

            $v = $data->create();

            if ($v != null) {
                $this->redirect(['index']);
            }
        }

        return $this->renderAjax('create', [
            'data' => $data,
        ]);
    }

    public function actionUpdate($id)
    {
        $data = Alimentos::findOne($id);

        if ($data->load(Yii::$app->request->post())) {
            if ($data->validate()) {
                $data->save(false);
                $this->redirect(['index']);
            }
        }

        return $this->renderAjax('update', [
            'data' => $data,
        ]);
    }

    public function actionDelete($response, $id)
    {
        if($id != null && $response == null)
        {
            echo $this->renderAjax('DeletePopUp', ['id' => $id]);

        }else {if ($id != null && $response != null) {
            if ($response == "yes") {

                $alimento = Alimentos::findOne($id);

                $alimentoApiID = $alimento->id_api;

                $alimento->delete();

                $api = AlimentoApi::find()->where(['id' => $alimentoApiID])->one();

                $api->delete();

                return $this->redirect(['index']);
            } else {
                return $this->redirect(['index']);
            }
        } else {
            return $this->redirect(['index']);
        }
        }
    }

    public function actionSearchfood($testsearch, $como){

        switch ($como) {
            case "nome":
                $find_result = Alimentos::find()->where(['id_alimento_user' => null])->andWhere(['like', 'nome', $testsearch])->all();
                break;
            case "calorias":
                $find_result = Alimentos::find()->where(['id_alimento_user' => null])->andWhere(['like', 'calorias', $testsearch])->all();
                break;
            case 'lipidos':
                $find_result = Alimentos::find()->where(['id_alimento_user' => null])->andWhere(['like', 'lipidos', $testsearch])->all();
                break;
            case 'carboidratos':
                $find_result = Alimentos::find()->where(['id_alimento_user' => null])->andWhere(['like', 'carboidratos', $testsearch])->all();
                break;
            case 'proteina':
                $find_result = Alimentos::find()->where(['id_alimento_user' => null])->andWhere(['like', 'proteina', $testsearch])->all();
                break;
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $find_result;
    }

}