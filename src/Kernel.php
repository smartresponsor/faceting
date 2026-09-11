<?php

declare(strict_types=1);

namespace App\Faceting;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

/**
 * Boots the standalone Faceting Symfony runtime and imports component configuration and routes.
 */
final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    /**
     * Loads component package and service configuration into the standalone Symfony container.
     */
    protected function configureContainer(ContainerBuilder $container, LoaderInterface $loader): void
    {
        $loader->load($this->getProjectDir().'/config/packages/*.yaml', 'glob');

        $environmentPackages = $this->getProjectDir().'/config/packages/'.$this->environment;
        if (is_dir($environmentPackages)) {
            $loader->load($environmentPackages.'/*.yaml', 'glob');
        }

        $loader->load($this->getProjectDir().'/config/services/*.yaml', 'glob');
    }

    /**
     * Imports component-owned route configuration for the standalone Faceting runtime.
     */
    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import($this->getProjectDir().'/config/routes/*.yaml');
    }
}
