<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "dia_utilizador".
 *
 * @property string $id
 * @property integer $id_user
 * @property string $id_dia
 *
 * @property ComplementoUser $idUser
 * @property Dia $idDia
 */
class DiaUtilizador extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'dia_utilizador';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['id_user', 'id_dia'], 'integer'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => ComplementoUser::className(), 'targetAttribute' => ['id_user' => 'id_user']],
            [['id_dia'], 'exist', 'skipOnError' => true, 'targetClass' => Dia::className(), 'targetAttribute' => ['id_dia' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_dia' => 'Id Dia',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(ComplementoUser::className(), ['id_user' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDia()
    {
        return $this->hasOne(Dia::className(), ['id' => 'id_dia']);
    }
}
