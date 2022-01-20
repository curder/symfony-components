<?php

use Curder\User;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\VarDumper\Cloner\VarCloner;
use Symfony\Component\VarDumper\Dumper\{CliDumper, HtmlDumper};

require __DIR__.'/vendor/autoload.php';

// 设置自定义的处理方式
VarDumper::setHandler(static function ($var) {
    $cloner = new VarCloner;

    $htmlDumper = new HtmlDumper; // 自定义 HTML 处理

    $htmlDumper->setTheme('light'); // 自定义设置主题

    $dumper = PHP_SAPI === 'cli' ? new CliDumper : $htmlDumper; // 指定对应 dumper 实例

    $dumper->dump($cloner->cloneVar($var)); // 执行 dump
});

$user = new User;

dd($user);
