<?php
return array(
    'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'Literal',
                'priority' => 1000,
                'options' => array(
                    'route' => '/user',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        'controller' => 'user',
                        'action'     => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    // ...
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables'  => array(
            'user' => 'CRAMauth\Controller\UserController'
        )
    )
);

/*'router' => array(
        'routes' => array(
            'user' => array(
                'type' => 'Segment',
                'priority' => 1000,
                'options' => array(
                    'route' => '/user/[:controller[/][:action]]',
                    'constraints' => array(
                        'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                        'action'     => '[a-zA-Z][a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'CRAMauth\Controller',
                        'controller'    => 'user',
                        'action'        => 'index'
                    )
                ),
            )
        )
    ),*/
