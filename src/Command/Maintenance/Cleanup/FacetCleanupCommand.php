<?php

declare(strict_types=1);

namespace App\Faceting\Command\Maintenance\Cleanup;

use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:faceting:cleanup')]
/**
 * Provides the explicit maintenance command for clearing persisted Faceting demo rows.
 */
final class FacetCleanupCommand extends Command
{
    /**
     * Initializes cleanup with the seeder service that owns demo-data removal behavior.
     */
    public function __construct(
        private readonly FacetDemoSeederServiceInterface $facetingDemoSeederService,
    ) {
        parent::__construct();
    }

    /**
     * Removes all demo facet rows and reports the number deleted to the operator.
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $count = $this->facetingDemoSeederService->clearAll();

        $io->success((string) $count.' facet rows were removed.');

        return Command::SUCCESS;
    }
}
