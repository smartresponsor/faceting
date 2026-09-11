<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Command\Demo\Reset;

use App\Faceting\Command\Demo\Reset\FacetDemoResetCommand;
use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class FacetDemoResetCommandTest extends TestCase
{
    public function testExecuteReportsReloadedFacetCount(): void
    {
        $service = new class implements FacetDemoSeederServiceInterface {
            public function replaceDemoData(): int
            {
                return 7;
            }

            public function clearAll(): int
            {
                return 0;
            }
        };

        $tester = new CommandTester(new FacetDemoResetCommand($service));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertStringContainsString('loaded 7 facets', strtolower($tester->getDisplay()));
    }
}
