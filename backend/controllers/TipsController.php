<?php
/**
 * Created by PhpStorm.
 * User: b_ml_
 * Date: 08/12/2017
 * Time: 19:35
 */

namespace backend\controllers;


use common\models\Tips;
use common\models\TipsChannel;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

class TipsController extends Controller
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
        ];
    }

    public function actionIndex($type)
    {
        $typeId =  TipsChannel::find()->select('id')->where(['channel' => $type])->one();
        $modelData = Tips::find()->where(['id_channel' => $typeId])->all();

        return $this->render('index', ['data' => $modelData, 'title' => $type]);
    }

    public function actionCreate($type)
    {
        $data = new Tips();

        $tipschannel =  TipsChannel::find()->where(['channel' => $type])->one();

        $data->id_channel = $tipschannel->id;

        if ($data->load(Yii::$app->request->post()) && $data->save()) {
            return $this->redirect(['index', 'type' => $type]);
        } else {
            return $this->renderAjax('create', [
                'data' => $data,
            ]);
        }
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