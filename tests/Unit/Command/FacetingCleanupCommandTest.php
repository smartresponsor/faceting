<?php

declare(strict_types=1);

namespace App\Tests\Unit\Command;

use App\Command\FacetingCleanupCommand;
use App\ServiceInterface\Demo\FacetingDemoSeederServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class FacetingCleanupCommandTest extends TestCase
{
    public function testExecuteReportsRemovedRows(): void
    {
        $service = new class () implements FacetingDemoSeederServiceInterface {
            public function replaceDemoData(): int
            {
                return 0;
            }

            public function clearAll(): int
            {
                return 7;
            }
        };

        $tester = new CommandTester(new FacetingCleanupCommand($service));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertStringContainsString('7 facet rows were removed.', $tester->getDisplay());
    }
}
