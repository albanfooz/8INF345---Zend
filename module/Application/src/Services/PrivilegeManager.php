<?php
namespace Application\Services;

use Zend\Db\TableGateway\TableGatewayInterface;

class PrivilegeManager {
    protected $_tableGateway;

    public function __construct(TableGatewayInterface $tableGateway){
        $this->_tableGateway = $tableGateway;
    }

    public function findByUsername($username){
        return $this->_tableGateway->select(['userId' => $username])->current();
    }
}
?>