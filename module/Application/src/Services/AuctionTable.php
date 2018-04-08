<?php
namespace Application\Services;

use Zend\Db\TableGateway\TableGatewayInterface;  
use Application\Model\Product;

class AuctionTable {
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

    public function insert(Product $a){
        $this->_tableGateway->insert($a->toValues());
    }

    public function find($id){
        return $this->_tableGateway->select(['id' => $id])->current();
    }

    public function update(Product $toUpdate, $data){
        return $this->_tableGateway->update($data,['id' => $toUpdate->_id]);
    }

    public function delete (Product $toDelete) {
        return $this->_tableGateway->delete(['id' => $toDelete->_id]);
    }
}
?>