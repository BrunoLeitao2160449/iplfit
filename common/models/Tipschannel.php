<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tips_channel".
 *
 * @property string $id
 * @property string $channel
 *
 * @property Tips[] $tips
 */
class Tipschannel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tips_channel';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['channel'], 'required'],
            [['channel'], 'string', 'max' => 80],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'channel' => 'Channel',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTips()
    {
        return $this->hasMany(Tips::className(), ['id_channel' => 'id']);
    }
}
