<?php
include 'vendor/autoload.php';

$log = new Lvht\Udplog('192.168.64.5');
$log->facility(LOG_KERN)
    ->hostname('baidu.com')
    ->procid(8848)
    ->msgid('demo')
    ->appname('php');

$log->error('欢迎使用基于UDP的syslog协议发送日志！');
$log->info('欢迎使用基于UDP的syslog协议发送日志！');
$log->debug('欢迎使用基于UDP的syslog协议发送日志！');
$log->emergency('欢迎使用基于UDP的syslog协议发送日志！');
