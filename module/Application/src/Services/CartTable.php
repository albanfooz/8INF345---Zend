<?php
namespace Application\Services;

use Application\Model\CartItem;
use Zend\Db\TableGateway\TableGatewayInterface;
use Application\Model\Product;

class CartTable {
    protected $_tableGateway;

    public function __construct(TableGatewayInterface $tableGateway){
        $this->_tableGateway = $tableGateway;
    }

    public function fetchAll() { 
        $resultSet = $this->_tableGateway->select(); 
        $return = array();
        foreach( $resultSet as $r )
            $return[]=$r;
        return $return; 
    }

    public function insert(CartItem $a){
        $this->_tableGateway->insert($a->toValues());
    }

    public function find($id){
        return $this->_tableGateway->select(['id' => $id])->current();
    }



    public function delete (Product $toDelete) {
        return $this->_tableGateway->delete(['id' => $toDelete->_id]);
    }
}
?>