<?php
namespace Application\Services;

use Application\Model\CartItem;
use Zend\Db\TableGateway\TableGatewayInterface;

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


    public function getUserCart () {
        $resultSet = $this->_tableGateway->select(['username' => $_SESSION['username']]);
        $return = array();
        foreach( $resultSet as $r )
            $return[]=$r->_idProduct;
        return $return;
    }
    public function delete (CartItem $toDelete) {
        return $this->_tableGateway->delete(['idProduct' => $toDelete->_idProduct, 'username' => $toDelete->_username]);
    }

    public function payCart () {
        // on vide le panier
        return $this->_tableGateway->delete(['username' => $_SESSION['username']]);
    }
}
?>