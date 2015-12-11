<?php

namespace Loo\Task;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Setup the database
 */
class DatabaseSetup extends Command
{
    /**
     * Configure
     */
    protected function configure()
    {
        $this
            ->setName('loo:database_setup')
            ->setDescription('Update the database. If not existing it will be created.')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(shell_exec('./vendor/bin/doctrine orm:schema-tool:update --force'));
        $output->writeln(shell_exec('./vendor/bin/doctrine orm:generate-proxies'));
    }
}
