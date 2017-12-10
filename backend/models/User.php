<?php
/**
 * Created by PhpStorm.
 * User: b_ml_
 * Date: 21/11/2017
 * Time: 09:48
 */

namespace backend\models;


use Yii;
use yii\base\Model;
use yii\httpclient\Client;

class User extends Model
{
    public function getUsers(){

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl(Yii::$app->params['api-basic-url'].'mais')
            ->send();

        if ($response->isOk) {
            return json_decode($response->content);
        } else {
            return null;
        }
    }

    public function deleteUser($id){

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('delete')
            ->setUrl(Yii::$app->params['api-basic-url'].'mais/'.$id)
            ->send();

        $deleteUser = $client->createRequest()
            ->setMethod('delete')
            ->setUrl(Yii::$app->params['api-basic-url'].'users/'.$id)
            ->send();

        if ($response->isOk) {
            return json_decode($response->content).json_decode($deleteUser->content);
        } else {
            return null;
        }
    }


}