<?php
namespace Onion\Framework\Event\Factory;

use Onion\Framework\Dependency\Interfaces\FactoryInterface;
use Onion\Framework\Event\Dispatcher;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Fig\EventDispatcher\AggregateProvider;

class DispatcherFactory implements FactoryInterface
{
    public function build(ContainerInterface $container): EventDispatcherInterface
    {
        $aggregate = new AggregateProvider();
        foreach ($container->get('events.providers') as $provider) {
            $aggregate->addProvider($container->get($provider));
        }

        $dispatcher = new Dispatcher($aggregate);

        return $dispatcher;
    }
}
