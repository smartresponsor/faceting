<?php

declare(strict_types=1);

namespace App\Command;

use App\ServiceInterface\Demo\FacetingDemoSeederServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:faceting:fixtures:load')]
final class FacetingFixturesLoadCommand extends Command
{
    public function __construct(
        private readonly FacetingDemoSeederServiceInterface $facetingDemoSeederService,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = $this->facetingDemoSeederService->replaceDemoData();

        $io->success(sprintf('Loaded %d demo facets.', $count));

        return Command::SUCCESS;
    }
}
