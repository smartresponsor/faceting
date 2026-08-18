<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Command;

use App\Faceting\Command\FacetingDemoResetCommand;
use App\Faceting\ServiceInterface\Demo\FacetingDemoSeederServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class FacetingDemoResetCommandTest extends TestCase
{
    public function testExecuteReportsReloadedFacetCount(): void
    {
        $service = new class implements FacetingDemoSeederServiceInterface {
            public function replaceDemoData(): int
            {
                return 7;
            }

            public function clearAll(): int
            {
                return 0;
            }
        };

        $tester = new CommandTester(new FacetingDemoResetCommand($service));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertStringContainsString('loaded 7 facets', strtolower($tester->getDisplay()));
    }
}
