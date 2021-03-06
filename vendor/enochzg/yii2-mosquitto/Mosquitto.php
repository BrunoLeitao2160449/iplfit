<?php

namespace enochzg\mosquitto;

use yii;

class Mosquitto extends yii\base\Component
{
    public $host;
    public $port;

    /**
     * @var CA的证书文件的位置
     */
    public $cafile = null;

    /**
     * @var CA为server端签发的证书文件的位置
     */
    public $certfile = null;

    /**
     * @var server端使用的key文件的位置
     */
    public $keyfile = null;
    public $password = null;

    /**
     * @var int heartbeat time (seconds)
     */
    public $keepalive = 60;

    protected $object;

    public function init()
    {
        $c = new Mosquitto();
        if($this->cafile && $this->certfile && $this->keyfile) {
            $c->setTlsCertificates($this->cafile, $this->certfile, $this->keyfile, $this->password);
        }
        $c->connect($this->host, $this->port, $this->keepalive);
        $this->object = $c;
    }

    /**
     * 推送
     * @param $topic 主题
     * @param $message 内容
     * @param int $quality 传送质
     * `0`:“至多一次”，消息发布完全依赖底层 TCP/IP 网络。会发生消息丢失或重复。这一级别可用于如下情况，环境传感器数据，丢失一次读记录无所谓，因为不久后还会有第二次发送。
     * `1`:“至少一次”，确保消息到达，但消息重复可能会发生。
     * `2`:“只有一次”，确保消息到达一次。这一级别可用于如下情况，在计费系统中，消息重复或丢失会导致不正确的结果
     * @return bool
     */
    public function publish($topic, $message, $quality = 2)
    {
        $obj = $this->object;
        $obj->publish($topic, $message, $quality);
        for ($i = 0; $i < 100; $i++) {
            $obj->loop(1);
        }
        return true;
    }

    /**
     * @param $cafile
     * @param $certfile
     * @param $keyfile
     * @param $password
     */
    public function setTlsCertificates($cafile, $certfile, $keyfile, $password)
    {
        $obj = $this->object;
        $obj->setTlsCertificates($cafile, $certfile, $keyfile, $password);
    }
}