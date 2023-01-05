<?php

defined('_JEXEC') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcherFactoryInterface;
use Joomla\CMS\Extension\ComponentInterface;
use Joomla\CMS\Extension\MVCComponent;
use Joomla\CMS\Extension\Service\Provider\ComponentDispatcherFactory;
use Joomla\CMS\Extension\Service\Provider\MVCFactory;
use Joomla\CMS\MVC\Factory\MVCFactoryInterface;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;


return new class implements ServiceProviderInterface {
	/**
	 * Registers the component services into the container.
	 *
	 * @param   Container  $container
	 *
	 * @since version 4.2.4
	 */
	public function register(Container $container): void {
        $container->registerServiceProvider(new MVCFactory('\\Fox5\\Component\\Courtroll'));
        $container->registerServiceProvider(new ComponentDispatcherFactory('\\Fox5\\Component\\Courtroll'));
        $container->set(
            ComponentInterface::class,
            function (Container $container) {
                $component = new MVCComponent($container->get(ComponentDispatcherFactoryInterface::class));
                $component->setMVCFactory($container->get(MVCFactoryInterface::class));

                return $component;
            }
        );
    }
};