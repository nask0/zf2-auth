<?php
return array(
    'router' => array(
        'routes' => array(
            'auth' => array(
                'type' => 'Segment',
                'options' => array(
                    'route' => '/auth/[:controller[/][:action]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'CRAMauth\Controller',
                        'controller'    => 'index',
                        'action'        => 'index'
                    )
                ),
            )
        )
    ),
);