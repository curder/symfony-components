<?php

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;

/**
 * Class CreateUserCommandTest
 *
 * @package \\${NAMESPACE}
 */
class CreateUserCommandTest extends TestCase
{
    /** @test */
    public function it_should_run_user_create_command(): void
    {
        // For a command './demo user:create'.
        $commandName = 'user:create';

        // Set up your Application with your command.
        $application = new \Symfony\Component\Console\Application();
        // Here's where you would inject any mocked dependencies as needed.
        $application->add(new CreateUserCommand);
        $foundCommand = $application->find($commandName);

        // Create a CommandTester with your Command class processed by your Application.
        $tester = new \Symfony\Component\Console\Tester\CommandTester($foundCommand);

        // Execute the command. This example would be the equivalent of
        // './demo user:create Curder'
        $code = $tester->execute([
            'command' => $commandName,
            'username' => 'Curder',
        ]);

        $output = $tester->getDisplay();

        $this->assertStringContainsString('Username: Curder', $output);
        $this->assertEquals(Command::SUCCESS, $code);
    }

    /** @test */
    public function it_has_require_user_name_argument(): void
    {
        $this->expectException(\Symfony\Component\Console\Exception\RuntimeException::class);
        $this->expectErrorMessage('Not enough arguments (missing: "username")');

        // For a command './demo user:create'.
        $commandName = 'user:create';

        // Set up your Application with your command.
        $application = new \Symfony\Component\Console\Application();
        // Here's where you would inject any mocked dependencies as needed.
        $application->add(new CreateUserCommand);
        $foundCommand = $application->find($commandName);

        // Create a CommandTester with your Command class processed by your Application.
        $tester = new \Symfony\Component\Console\Tester\CommandTester($foundCommand);

        // Execute the command. This example would be the equivalent of
        // './demo user:create'
        $tester->execute([
            'command' => $commandName,
        ]);
    }
}
