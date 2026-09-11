<?php

declare(strict_types=1);

namespace App\Faceting\Tests\Unit\Command\Demo\Fixture;

use App\Faceting\Command\Demo\Fixture\FacetFixturesLoadCommand;
use App\Faceting\ServiceInterface\Demo\FacetDemoSeederServiceInterface;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Tester\CommandTester;

final class FacetFixturesLoadCommandTest extends TestCase
{
    public function testExecuteReportsLoadedFacetCount(): void
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

        $tester = new CommandTester(new FacetFixturesLoadCommand($service));

        self::assertSame(Command::SUCCESS, $tester->execute([]));
        self::assertStringContainsString('Loaded 7 demo facets.', $tester->getDisplay());
    }
}
