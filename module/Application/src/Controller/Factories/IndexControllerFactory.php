<?php
namespace Application\Controller\Factories;

use Application\Services\CartTable;
use Application\Services\PrivilegeManager;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\Session\SessionManager;
use Zend\Authentication\Storage\Session as SessionStorage;
use User\Services\AuthAdapter;
use Interop\Container\ContainerInterface;
use Application\Controller\IndexController;
use Application\Services\AuctionTable;

/**
 * The factory responsible for creating of authentication service.
 */
class IndexControllerFactory implements FactoryInterface
{
    /**
     * This method creates the Zend\Authentication\AuthenticationService service 
     * and returns its instance. 
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {
        return new IndexController($container->get(AuctionTable::class), $container->get(CartTable::class));
    }
}
