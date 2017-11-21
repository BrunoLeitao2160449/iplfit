<?php
/**
 * Created by PhpStorm.
 * User: b_ml_
 * Date: 21/11/2017
 * Time: 09:48
 */

namespace backend\models;


use yii\base\Model;
use yii\httpclient\Client;

class User extends Model
{
    public function getUsers(){

        $client = new Client();
        $response = $client->createRequest()
            ->setMethod('get')
            ->setUrl('http://localhost:8888/complemento')
            ->send();

        if ($response->isOk) {
            return json_decode($response->content);
        } else {
            return null;
        }
    }

}