<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Application;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

return [
    'router' => [
        'routes' => [
            'index' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/[:action[/:id]]',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'index',
                    ],
                ],
            ],
            'cart' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/cart',
                    'constraints' => [
                        'action' => '[a-zA-Z][a-zA-Z]*',
                        'id' => '[0-9]*',
                    ],
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action' => 'cart',
                    ],
                ],
            ]
        ],
    ],
    'access_filter' => [
        'options' => [
            'mode' => 'restrictive'
        ],
        'controllers' => [
            Controller\IndexController::class => [
                ['actions' => ['index', 'edit', 'delete', 'create', 'addtocart', 'cart', 'removefromcart', 'paycart'], 'allow' => '*'],
                ['actions' => ['index'], 'allow' => '*'],
                ['actions' => ['addtocart'], 'allow' => '*'],
                ['actions' => ['removefromcart'], 'allow' => '*'],
                ['actions' => ['cart'], 'allow' => '*'],
                ['actions' => ['admin'], 'allow' => '@'],
                ['actions' => ['edit'], 'allow' => '@'],
                ['actions' => ['delete'], 'allow' => '@'],
                ['actions' => ['create'], 'allow' => '@'],
                ['actions' => ['paycart'], 'allow' => '*']


            ],
        ]
    ],
    'service_manager' => [
        'factories' => [
            Services\AuctionTable::class => Services\Factories\AuctionTableFactory::class,
            Services\AuctionTableGateway::class => Services\Factories\AuctionTableGatewayFactory::class,
            Services\NavManager::class => Services\Factories\NavManagerFactory::class,
            Services\CartTable::class => Services\Factories\CartTableFactory::class,
            Services\CartTableGateway::class => Services\Factories\CartTableGatewayFactory::class,

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => Controller\Factories\IndexControllerFactory::class,
        ],
    ],
    'view_helpers' => [
        'factories' => [
            View\Helper\Menu::class => View\Helper\Factory\MenuFactory::class,
        ],
        'aliases' => [
            'mainMenu' => View\Helper\Menu::class
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/layout.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
        'strategies' => [
            'ViewJsonStrategy',
        ]
    ],
];
