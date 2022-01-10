## [Console Command](https://symfony.com/doc/current/console.html)



```php
<?php

namespace Curder;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected function configure()
    {
        $this->setName('user:create') // 设置命令名称
             ->setDescription('Create new user') // 命令简短描述
             ->setHelp('This command allows you to create users...') // 运行命令时使用 "--help" 选项时的完整命令描述
             ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        // 使用 getArgument() 取出参数值
        $output->writeln('Username: <info>' . $input->getArgument('username') . '<info>');

        return self::SUCCESS;
    }
```

## 单元测试

```
composer test
```

更多使用请[查看文档](https://symfony.com/doc/current/components/console.html)


