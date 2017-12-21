<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alimentos".
 *
 * @property string $id
 * @property string $id_api
 * @property string $id_alimento_user
 * @property string $nome
 * @property string $calorias
 * @property string $lipidos
 * @property string $carboidratos
 * @property string $proteina
 *
 * @property AlimentoApi $idApi
 * @property AlimentoUser $idAlimentoUser
 * @property RefeicaoDia[] $refeicaoDias
 */
class Alimentos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alimentos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_api', 'id_alimento_user'], 'integer'],
            [['calorias', 'lipidos', 'carboidratos', 'proteina'], 'number'],
            [['nome'], 'string', 'max' => 80],
            [['id_api'], 'exist', 'skipOnError' => true, 'targetClass' => AlimentoApi::className(), 'targetAttribute' => ['id_api' => 'id']],
            [['id_alimento_user'], 'exist', 'skipOnError' => true, 'targetClass' => AlimentoUser::className(), 'targetAttribute' => ['id_alimento_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_api' => 'Id Api',
            'id_alimento_user' => 'Id Alimento User',
            'nome' => 'Nome',
            'calorias' => 'Calorias',
            'lipidos' => 'Lipidos',
            'carboidratos' => 'Carboidratos',
            'proteina' => 'Proteina',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdApi()
    {
        return $this->hasOne(AlimentoApi::className(), ['id' => 'id_api']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlimentoUser()
    {
        return $this->hasOne(AlimentoUser::className(), ['id' => 'id_alimento_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefeicaoDias()
    {
        return $this->hasMany(RefeicaoDia::className(), ['id_alimento' => 'id']);
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $prod_id= $this->id;
        $myObj=new \stdClass();
        $myObj->id=$prod_id;
        $myJSON = json_encode($myObj);

        $this->FazPublish("test",$myJSON);
    }

    public function FazPublish($canal,$msg)
    {
        $server = "5.196.27.244";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "test";
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
