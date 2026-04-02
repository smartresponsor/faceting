<?php

declare(strict_types=1);

namespace App\Tests\Unit\Command;

use App\Command\FacetingFixturesLoadCommand;
use App\ServiceInterface\Demo\FacetingDemoSeederServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class FacetingFixturesLoadCommandTest extends TestCase
{
    public function testExecuteReportsLoadedFacetCount(): void
    {
        $service = new class () implements FacetingDemoSeederServiceInterface {
            public function replaceDemoData(): int
            {
                return 7;
            }

            public function clearAll(): int
            {
                return 0;
            }
        };

        $tester = new CommandTester(new FacetingFixturesLoadCommand($service));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertStringContainsString('Loaded 7 demo facets.', $tester->getDisplay());
    }
}
