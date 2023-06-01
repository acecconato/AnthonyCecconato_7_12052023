<?php

declare(strict_types=1);

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

#[AsCommand('app:setup')]
class SetupCommand extends Command
{
    public function run(InputInterface $input, OutputInterface $output): int
    {
        $output->writeln('Running setup command...');

        if (!file_exists('config/jwt/private.pem') && !file_exists('config/jwt/public.pem')) {
            $process = new Process(['php', 'bin/console', 'lexik:jwt:generate-keypair']);
            $process->run();

            if (!$process->isSuccessful()) {
                throw new \RuntimeException('Failed to generate JWT key pair.');
            }

            $output->writeln('JWT key pair generated.');
        } else {
            $output->writeln('JWT key pair already exists. Skipping generation.');
        }

        return 0;
    }
}
