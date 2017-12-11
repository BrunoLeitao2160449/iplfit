<?php
namespace backend\models;

use yii\base\Model;
use common\models\Alimentos;
use common\models\AlimentoApi;


class CreateForm extends Model
{
    public $nome;
    public $calorias;
    public $lipidos;
    public $carboidratos;
    public $proteina;


    public function rules()
    {
        return [

            ['nome', 'required'],

            ['calorias', 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['lipidos', 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['carboidratos', 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
            ['proteina', 'number', 'numberPattern' => '/^\s*[-+]?[0-9]*[.]?[0-9]+([eE][-+]?[0-9]+)?\s*$/'],
        ];
    }

    public function create()
    {
        if($this->validate()) {

            $data = new Alimentos();

            $countIdAPI = AlimentoApi::find()->count();

            if($countIdAPI == 0)
            {
                $alimentoApi = new AlimentoApi();
                $alimentoApi->id_api = 1;
                $alimentoApi->save(false);

                $data->id_api = $alimentoApi->id;
                $data->id_alimento_user = null;
                $data->nome = $this->nome;
                $data->calorias= $this->calorias;
                $data->lipidos = $this->lipidos;
                $data->carboidratos = $this->carboidratos;
                $data->proteina = $this->proteina;
                $data->save(false);
            }
            else
            {
                $maxIdAPI = AlimentoApi::find()->max('id_api');

                $maxIdAPI = $maxIdAPI + 1;

                $alimentoApi = new AlimentoApi();
                $alimentoApi->id_api = $maxIdAPI;
                $alimentoApi->save(false);


                $data->id_api = $alimentoApi->id;
                $data->id_alimento_user = null;
                $data->nome = $this->nome;
                $data->calorias= $this->calorias;
                $data->lipidos = $this->lipidos;
                $data->carboidratos = $this->carboidratos;
                $data->proteina = $this->proteina;
                $data->save(false);
            }

            return $data;
        }
        return null;
    }
}
