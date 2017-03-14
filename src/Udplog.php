<?php
namespace Lvht;

use Psr\Log\LoggerInterface;

class Udplog implements LoggerInterface
{
    private $addr;
    private $port;
    private $sock;

    private $facility;
    private $hostname = '-';
    private $appname = '-';
    private $procid = '-';
    private $msgid = '-';

    public function __construct(string $addr, int $port = 514)
    {
        $this->addr = $addr;
        $this->port = $port;
        $this->sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
    }

    public function facility(int $facility) : self
    {
        $this->facility = $facility << 2;
        return $this;
    }

    public function hostname(string $hostname) : self
    {
        $this->hostname = $hostname;
        return $this;
    }

    public function appname(string $appname) : self
    {
        $this->appname = $appname;
        return $this;
    }

    public function procid(string $procid) : self
    {
        $this->procid = $procid;
        return $this;
    }

    public function msgid(string $msgid) : self
    {
        $this->msgid = $msgid;
        return $this;
    }

    public function log($level, $message, array $context = array())
    {
        $prival = $this->facility | $level;
        $timestamp = date('c', time());

        $msg = sprintf("<%d>1 %s %s %s %s %s - \xEF\xBB\xBF%s|%s", $prival, $timestamp,
            $this->hostname, $this->appname, $this->procid, $this->msgid,
            $message, json_encode($context));

        socket_sendto($this->sock, $msg, strlen($msg), 0, $this->addr, $this->port);
    }

    public function emergency($message, array $context = array())
    {
        $this->log(LOG_EMERG, $message, $context);
    }

    public function alert($message, array $context = array())
    {
        $this->log(LOG_ALERT, $message, $context);
    }

    public function critical($message, array $context = array())
    {
        $this->log(LOG_EMERG, $message, $context);
    }

    public function error($message, array $context = array())
    {
        $this->log(LOG_ERR, $message, $context);
    }

    public function warning($message, array $context = array())
    {
        $this->log(LOG_WARNING, $message, $context);
    }

    public function notice($message, array $context = array())
    {
        $this->log(LOG_NOTICE, $message, $context);
    }

    public function info($message, array $context = array())
    {
        $this->log(LOG_INFO, $message, $context);
    }

    public function debug($message, array $context = array())
    {
        $this->log(LOG_DEBUG, $message, $context);
    }
}
