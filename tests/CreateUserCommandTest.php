<?php

use Curder\CreateUserCommand;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class CreateUserCommandTest
 *
 * @package \\${NAMESPACE}
 */
class CreateUserCommandTest extends TestCase
{
    protected $command_name;
    protected $tester;

    protected function setUp() : void
    {
        parent::setUp();
        $this->command_name = 'user:create';
        // Set up your Application with your command.
        $application = new Application();
        // Here's where you would inject any mocked dependencies as needed.
        $application->add(new CreateUserCommand);
        $foundCommand = $application->find($this->command_name);
        $this->tester = new CommandTester($foundCommand);
    }

    /** @test */
    public function it_should_run_user_create_command(): void
    {
        // Execute the command. This example would be the equivalent of
        // './demo user:create Curder'
        $code = $this->tester->execute([
            'command' => $this->command_name,
            'username' => 'Curder',
        ]);

        $output = $this->tester->getDisplay();

        $this->assertStringContainsString('Username: Curder', $output);
        $this->assertEquals(Command::SUCCESS, $code);
    }

    /** @test */
    public function it_has_require_user_name_argument(): void
    {
        $this->expectException(\Symfony\Component\Console\Exception\RuntimeException::class);
        $this->expectErrorMessage('Not enough arguments (missing: "username")');


        // Execute the command. This example would be the equivalent of
        // './demo user:create'
        $this->tester->execute([
            'command' => $this->command_name,
        ]);
    }
}
