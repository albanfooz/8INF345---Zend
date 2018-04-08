<?php
/**
 * Created by PhpStorm.
 * User: Axel
 * Date: 08/04/2018
 * Time: 00:30
 */

namespace User\Services\Factories;
use User\Models\UserPrivilege;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use Interop\Container\ContainerInterface;
use Zend\Db\Adapter\AdapterInterface;
use Application\Model\Product;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\ModuleManager\Feature\ConfigProviderInterface;

class PrivilegeGatewayFactory implements FactoryInterface
{
    public function __invoke(ContainerInterface $container,
                             $requestedName, array $options = null)
    {
        $dbAdapter = $container->get(AdapterInterface::class);
        $resultSetPrototype = new ResultSet();
        $resultSetPrototype->setArrayObjectPrototype(new UserPrivilege());
        return new TableGateway('userprivilege', $dbAdapter, null, $resultSetPrototype);
    }
}
