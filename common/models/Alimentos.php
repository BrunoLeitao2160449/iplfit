<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alimentos".
 *
 * @property string $id
 * @property string $id_api
 * @property integer $id_alimento_user
 * @property string $nome
 * @property string $calorias
 * @property string $lipidos
 * @property string $carboidratos
 * @property string $proteina
 *
 * @property AlimentoApi $idApi
 * @property ComplementoUser $idAlimentoUser
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
            [['id_alimento_user'], 'exist', 'skipOnError' => true, 'targetClass' => ComplementoUser::className(), 'targetAttribute' => ['id_alimento_user' => 'id_user']],
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
        return $this->hasOne(ComplementoUser::className(), ['id_user' => 'id_alimento_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRefeicaoDias()
    {
        return $this->hasMany(RefeicaoDia::className(), ['id_alimento' => 'id']);
    }
}
