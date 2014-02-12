<?php
namespace CRAMauth;

class Module
{
    public function onBootstrap($e)
    {
        // Register a "render" event, at high priority (so it executes prior to the view attempting to render)
        $app = $e->getApplication();
        $app->getEventManager()->attach('render', array($this, 'registerJsonStrategy'), 100);
    }

    public function registerJsonStrategy($e)
    {
        $app          = $e->getTarget();
        $locator      = $app->getServiceManager();
        $view         = $locator->get('Zend\View\View');
        $jsonStrategy = $locator->get('ViewJsonStrategy');

        // Attach strategy, which is a listener aggregate, at high priority
        $view->getEventManager()->attach($jsonStrategy, 100);
    }

    public function getConfig()
    {
        return (include __DIR__ . '/config/module.config.php');
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
