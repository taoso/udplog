# udplog

`lvht/udplog` is a [PSR3](http://www.php-fig.org/psr/psr-3/) implementation,
which sending log according [RFC 5424](https://tools.ietf.org/html/rfc5424).

## Install

	composer require lvht/udplog

## Usage

```php
<?php
$log = new Lvht\Udplog('ip addr', 'port');
$log->facility(LOG_KERN)
    ->hostname('foo.com')
    ->procid(8848)
    ->msgid('demo')
    ->appname('php');

$log->error('欢迎使用基于UDP的syslog协议发送日志！');
$log->info('欢迎使用基于UDP的syslog协议发送日志！');
$log->debug('欢迎使用基于UDP的syslog协议发送日志！');
$log->emergency('欢迎使用基于UDP的syslog协议发送日志！');
```

## Status
duplog implements PSR3, so the API is stable. And I want to make it v1.0.0.
However, duplog does not support the [STRUCTURED-DATA](https://tools.ietf.org/html/rfc5424#section-6.3).
We will add this support in the future if needed.
