<?php

declare(strict_types=1);

namespace App\Faceting\Command\Demo\Fixture;

use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:faceting:fixtures:load')]
final class FacetFixturesLoadCommand extends Command
{
    public function __construct(
        private readonly FacetDemoSeederServiceInterface $facetingDemoSeederService,
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
