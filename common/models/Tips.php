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
        return $this->hasOne(TipsChannel::className(), ['id' => 'id_channel'])->inverseOf('tips');
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub

        $channel = TipsChannel::find()->where(['id' => $this->id_channel])->one();

        $this->FazPublish($channel->channel, $this->title."\n".$this->content);
    }

    public function FazPublish($canal,$msg)
    {
        $server = "5.196.27.244";
        $port = 1883;
        $username = ""; // set your username
        $password = ""; // set your password
        $client_id = "yii";
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
