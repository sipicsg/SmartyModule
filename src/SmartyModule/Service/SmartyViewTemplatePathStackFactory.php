<?php

/**
 * @link        https://github.com/MurgaNikolay/SmartyModule for the canonical source repository
 * @license     http://framework.zend.com/license/new-bsd New BSD License
 * @author      Murga Nikolay <work@murga.kiev.ua>
 * @package     SmartyModule
 */

namespace SmartyModule\Service;

use Zend\View\Resolver as ViewResolver;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class SmartyViewTemplatePathStackFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->createService($container->get('ServiceManager'));
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');
        $templatePathStack = new ViewResolver\TemplatePathStack();
        if (is_array($config) && isset($config['view_manager'])) {
            $config = $config['view_manager'];
            if (is_array($config) && isset($config['template_path_stack'])) {
                $templatePathStack->addPaths($config['template_path_stack']);
            }
            if (is_array($config) && isset($config['smarty_default_suffix'])) {
                $templatePathStack->setDefaultSuffix($config['smarty_default_suffix']);
            }
        }

        return $templatePathStack;
    }

}