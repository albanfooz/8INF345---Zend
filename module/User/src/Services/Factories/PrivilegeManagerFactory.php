<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 08/04/2018
 * Time: 00:25
 */

namespace Application\Services\Factories;


use Application\Services\PrivilegeManager;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Interop\Container\ContainerInterface;
use Application\Services\PrivilegeGateway;
use Application\Services\AuctionTable;

class PrivilegeManagerFactory implements FactoryInterface
{

    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        $tableGateway = $container->get(PrivilegeGateway::class);
        $table = new PrivilegeManager($tableGateway);
        return $table;
    }
}
