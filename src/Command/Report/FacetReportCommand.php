<?php

declare(strict_types=1);

namespace App\Faceting\Command\Report;

use App\Faceting\ServiceInterface\Report\FacetReportServiceInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand(name: 'app:faceting:report')]
final class FacetReportCommand extends Command
{
    public function __construct(
        private readonly FacetReportServiceInterface $facetingReportService,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $report = $this->facetingReportService->buildDemoFacetReport();

        $io->title('Faceting report');
        $io->definitionList(
            ['Total facets' => (string) $report->total],
            ['Visible facets' => (string) $report->visible],
            ['Hidden facets' => (string) $report->hidden],
        );

        $rows = [];
        foreach ($report->byType as $type => $count) {
            $rows[] = [$type, (string) $count];
        }

        $io->table(['Type', 'Count'], $rows);

        return Command::SUCCESS;
    }
}
