<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Command\Maintenance\Cleanup;

use App\Faceting\Command\Maintenance\Cleanup\FacetCleanupCommand;
use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class FacetCleanupCommandTest extends TestCase
{
    public function testExecuteReportsRemovedRows(): void
    {
        $service = new class implements FacetDemoSeederServiceInterface {
            public function replaceDemoData(): int
            {
                return 0;
            }

            public function clearAll(): int
            {
                return 7;
            }
        };

        $tester = new CommandTester(new FacetCleanupCommand($service));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertStringContainsString('7 facet rows were removed.', $tester->getDisplay());
    }
}
