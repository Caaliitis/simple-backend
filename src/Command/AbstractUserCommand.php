<?php

namespace App\Command;

use App\Service\UserCommandUtil;
use Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

abstract class AbstractUserCommand extends Command
{
    protected $userUtil;

    public function __construct(UserCommandUtil $userUtil)
    {
        $this->userUtil = $userUtil;

        parent::__construct();
    }

    protected function configure(): void
    {
        $this->setHelp($this->getHelpText());
    }

    abstract protected function getHelpText(): string;

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @see Command
     */
    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        $questions = [];

        if (!$input->getArgument('email')) {
            $question = new Question('Please choose an email:');
            $question->setValidator(static function ($email) {
                if (empty($email)) {
                    throw new Exception('Email can not be empty');
                }
                return $email;
            });
            $questions['email'] = $question;
        }

        if (!$input->getArgument('role')) {
            $question = new Question('Please choose an role:');
            $question->setValidator(static function ($role) {
                if (empty($role)) {
                    throw new Exception('Role can not be empty');
                }
                return $role;
            });
            $questions['role'] = $question;
        }

        foreach ($questions as $name => $question) {
            $answer = $this->getHelper('question')->ask($input, $output, $question);
            $input->setArgument($name, $answer);
        }
    }
}
