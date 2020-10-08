<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DemoteUserCommand extends AbstractUserCommand
{
    /**
     * @see Command
     */
    protected function configure(): void
    {
        parent::configure();
        $this
            ->setName('app:user:demote')
            ->setDescription('Demotes a user by removing a role')
            ->setDefinition([
                new InputArgument('email', InputArgument::REQUIRED, 'The email'),
                new InputArgument('role', InputArgument::REQUIRED, 'Removes the users role'),
            ]);

        parent::configure();
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @see Command
     */
    protected function execute(InputInterface $input, OutputInterface $output): void
    {
        $email = $input->getArgument('email');
        $role = $input->getArgument('role');

        $this->userUtil->demote($email, $role);

        $output->writeln(sprintf('Role "%s" has been removed from user "%s".', $role, $email));
    }

    protected function getHelpText(): string
    {
        return <<<EOT
The <info>app:user:demote</info> command demotes a user by removing a role
  <info>php app/console app:user:demote matthieu@email.com ROLE_CUSTOM</info>
EOT;
    }
}
