<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateUserCommand
 *
 * @package App\Command
 */
class CreateUserCommand extends AbstractUserCommand
{

    /**
     * @see Command
     */
    protected function configure(): void
    {
        $this
            ->setName('app:user:create')
            ->setDescription('Create a user.')
            ->setDefinition([
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('password', InputArgument::REQUIRED, 'The password'),
                new InputArgument('role', null, 'Set the users role'),
            ]);

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');
        $role = $input->getArgument('role');

        $this->userUtil->create($email, $password, $role);

        $output->writeln(sprintf('Created user <comment>%s</comment>', $email));

        return 1;
    }

    protected function getHelpText(): string
    {
        return <<<EOT
The <info>app:user:create</info> command creates a user:
  <info>php app/console app:user:create matthieu@example.com</info>
This interactive shell will ask you for an password.
You can alternatively specify the email and password as the first and second arguments:
  <info>php bin/console app:user:create matthieu@example.com mypassword</info>
You can create a super admin via the super-admin flag:
  <info>php app/console app:user:create matthieu@example.com mypassword ROLE_SUPER_ADMIN</info>
EOT;
    }
}
