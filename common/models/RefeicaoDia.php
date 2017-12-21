<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "refeicao_dia".
 *
 * @property string $id
 * @property string $id_dia
 * @property string $id_refeicao
 * @property string $id_alimento
 * @property string $peso
 * @property string $obs
 *
 * @property Dia $idDia
 * @property Refeicao $idRefeicao
 * @property Alimentos $idAlimento
 */
class RefeicaoDia extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'refeicao_dia';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_dia', 'id_refeicao', 'id_alimento'], 'integer'],
            [['peso'], 'number'],
            [['obs'], 'string', 'max' => 500],
            [['id_dia'], 'exist', 'skipOnError' => true, 'targetClass' => Dia::className(), 'targetAttribute' => ['id_dia' => 'id']],
            [['id_refeicao'], 'exist', 'skipOnError' => true, 'targetClass' => Refeicao::className(), 'targetAttribute' => ['id_refeicao' => 'id']],
            [['id_alimento'], 'exist', 'skipOnError' => true, 'targetClass' => Alimentos::className(), 'targetAttribute' => ['id_alimento' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_dia' => 'Id Dia',
            'id_refeicao' => 'Id Refeicao',
            'id_alimento' => 'Id Alimento',
            'peso' => 'Peso',
            'obs' => 'Obs',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdDia()
    {
        return $this->hasOne(Dia::className(), ['id' => 'id_dia']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdRefeicao()
    {
        return $this->hasOne(Refeicao::className(), ['id' => 'id_refeicao']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAlimento()
    {
        return $this->hasOne(Alimentos::className(), ['id' => 'id_alimento']);
    }
}
