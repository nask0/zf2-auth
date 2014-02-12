<?php
namespace CRAMauth;

class Module
{
    public function getConfig()
    {
        return
            (include __DIR__ . '/config/module.config.php') +
            (include __DIR__ . '/config/routes.config.php');
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
