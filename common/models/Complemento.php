<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "complemento_user".
 *
 * @property integer $id_user
 * @property integer $id_activity
 * @property string $nome
 * @property string $data_nasc
 * @property string $peso
 * @property string $altura
 * @property string $meta_peso
 * @property string $obs
 *
 * @property Alimentos[] $alimentos
 * @property User $idUser
 * @property ActivityLevel $idActivity
 * @property DiaUtilizador[] $diaUtilizadors
 */
class Complemento extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'complemento_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user', 'id_activity', 'nome', 'data_nasc'], 'required'],
            [['id_user', 'id_activity'], 'integer'],
            [['data_nasc'], 'safe'],
            [['peso', 'altura', 'meta_peso'], 'number'],
            [['nome'], 'string', 'max' => 110],
            [['obs'], 'string', 'max' => 500],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
            [['id_activity'], 'exist', 'skipOnError' => true, 'targetClass' => ActivityLevel::className(), 'targetAttribute' => ['id_activity' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_user' => 'Id User',
            'id_activity' => 'Id Activity',
            'nome' => 'Nome',
            'data_nasc' => 'Data Nasc',
            'peso' => 'Peso',
            'altura' => 'Altura',
            'meta_peso' => 'Meta Peso',
            'obs' => 'Obs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimentoUsers()
    {
        return $this->hasMany(AlimentoUser::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getActivity()
    {
        return $this->hasOne(ActivityLevel::className(), ['id' => 'id_activity']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDiaUtilizadors()
    {
        return $this->hasMany(DiaUtilizador::className(), ['id_user' => 'id_user']);
    }
}
