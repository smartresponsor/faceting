<?php

declare(strict_types=1);

namespace App\Faceting\Command\Maintenance\Diagnostics;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:faceting:diagnostics')]
final class FacetDiagnosticsCommand extends Command
{
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->success('Faceting diagnostics entrypoint is available.');

        return Command::SUCCESS;
    }
}
