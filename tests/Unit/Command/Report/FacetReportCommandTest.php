<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Command\Report;

use App\Faceting\Command\Report\FacetReportCommand;
use App\Faceting\ServiceInterface\Report\FacetReportServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class FacetReportCommandTest extends TestCase
{
    public function testExecuteRendersReportSummary(): void
    {
        $service = new class implements FacetReportServiceInterface {
            public function buildDemoFacetReport(): array
            {
                return [
                    'total' => 7,
                    'visible' => 6,
                    'hidden' => 1,
                    'byType' => ['boolean' => 1, 'hierarchy' => 1, 'range' => 1, 'term' => 4],
                ];
            }
        };

        $tester = new CommandTester(new FacetReportCommand($service));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertStringContainsString('Faceting report', $tester->getDisplay());
        self::assertStringContainsString('Total facets', $tester->getDisplay());
        self::assertStringContainsString('7', $tester->getDisplay());
        self::assertStringContainsString('term', $tester->getDisplay());
    }
}
