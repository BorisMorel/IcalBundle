<?php

namespace BOMO\IcalBundle\Tests;


use PHPUnit\Framework\TestCase;

class DependencyInjectionTest extends TestCase
{
    /**
     * @return TestKernel
     */
    protected function buildKernel()
    {
        $kernel = new TestKernel(__DIR__.'/../Resources/config/services.xml');
        $kernel->boot();

        return $kernel;
    }

    public function testServicesRegistration()
    {
        $kernel = $this->buildKernel();
        $container = $kernel->getContainer();

        $key = 'bomo_ical.ics_provider';
        $this->assertTrue($container->has($key), "Service $key doesn't seem to be registered");

        $service = $container->get($key);
        $this->assertNotNull($service, "Instance of $key should not be null");
    }
}
