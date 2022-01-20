# [Symfony VarDumper](https://symfony.com/doc/current/components/var_dumper.html)

[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/curder/symfony-components/run-tests?label=tests)](https://github.com/curder/symfony-components/actions?query=workflow%3Arun-tests+branch%3Avar-dumper)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/curder/symfony-components/Check%20&%20fix%20styling?label=code%20style)](https://github.com/curder/symfony-components/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Avar-dumper)


```php
<?php

require __DIR__.'/vendor/autoload.php';

// 创建一个变量，它可以是任何东西！
$someVar = ...;

dump($someVar);
```

## 单元测试

```php
composer test
```
