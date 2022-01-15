<?php

namespace Curder;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class CreateUserCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('user:create') // 设置命令名称
             ->setDescription('Create new user') // 命令简短描述
             ->setHelp('This command allows you to create users...') // 运行命令时使用 "--help" 选项时的完整命令描述
             ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.')
//             ->addOption('is_admin', 'a', InputArgument::OPTIONAL, 'It\'s admin user.')
//             ->setDefinition(
//                 new InputDefinition([
//                     new InputArgument('username', InputArgument::REQUIRED, 'The username of the user.'),
//                     new InputOption('is_admin', 'a', InputArgument::OPTIONAL, 'It\'s admin user.'),
//                ])
//             )
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

        return Command::SUCCESS;
    }
}
