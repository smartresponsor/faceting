<?php

declare(strict_types=1);

namespace App\Faceting\Command\Demo\Reset;

use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:faceting:demo:reset')]
/**
 * Resets Faceting demo persistence back to the deterministic demonstration dataset.
 */
final class FacetDemoResetCommand extends Command
{
    /**
     * Initializes the reset command with the component-owned demo seeding service.
     */
    public function __construct(
        private readonly FacetDemoSeederServiceInterface $facetingDemoSeederService,
    ) {
        parent::__construct();
    }

    /**
     * Replaces all demo rows and reports the resulting facet count to the console.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = $this->facetingDemoSeederService->replaceDemoData();

        $io->success(sprintf('Reset demo data and loaded %d facets.', $count));

        return Command::SUCCESS;
    }
}
