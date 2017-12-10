<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "alimento_api".
 *
 * @property string $id
 * @property string $id_api
 *
 * @property Alimentos[] $alimentos
 */
class AlimentoApi extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'alimento_api';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_api'], 'integer'],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlimentos()
    {
        return $this->hasMany(Alimentos::className(), ['id_api' => 'id']);
    }
}
