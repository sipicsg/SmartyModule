<?php
namespace SmartyModule\Service;

use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\ServiceManager\Factory\FactoryInterface;
use SmartyModule\View\Strategy\SmartyStrategy;
use Interop\Container\ContainerInterface;

/**
 * Created by IntelliJ IDEA.
 * User: Nikolay
 * Date: 23.01.13
 * Time: 13:39
 */
class SmartyStrategyFactory implements FactoryInterface {

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->createService($container->get('ServiceManager'));
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return SmartyStrategy
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        try {
            $smartyRenderer = $serviceLocator->get('SmartyRenderer');
        }
        catch (\Exception $e) {
            die($e->getMessage());
        }

        $smartyStrategy = new SmartyStrategy($smartyRenderer);
        return $smartyStrategy;
    }
}
