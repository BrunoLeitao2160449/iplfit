<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tips".
 *
 * @property string $id
 * @property string $id_channel
 * @property string $title
 * @property string $content
 *
 * @property TipsChannel $idChannel
 */
class Tips extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tips';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_channel', 'title', 'content'], 'required'],
            [['id_channel'], 'integer'],
            [['content'], 'string'],
            [['title'], 'string', 'max' => 100],
            [['id_channel'], 'exist', 'skipOnError' => true, 'targetClass' => TipsChannel::className(), 'targetAttribute' => ['id_channel' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_channel' => 'Id Channel',
            'title' => 'Title',
            'content' => 'Content',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdChannel()
    {
        return $this->hasOne(TipsChannel::className(), ['id' => 'id_channel']);
    }
}
