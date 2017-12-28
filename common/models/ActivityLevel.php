<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "activity_level".
 *
 * @property integer $id
 * @property string $level
 * @property string $description
 *
 * @property ComplementoUser[] $complementoUsers
 */
class ActivityLevel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'activity_level';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['level', 'description'], 'required'],
            [['level'], 'number'],
            [['description'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'level' => 'Level',
            'description' => 'Description',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComplementoUsers()
    {
        return $this->hasMany(Complemento::className(), ['id_activity' => 'id'])->inverseOf('idActivity');
    }
}
