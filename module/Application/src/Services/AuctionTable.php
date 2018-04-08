<?php
namespace Application\Services;

use Zend\Db\TableGateway\TableGatewayInterface;  
use Application\Model\Product;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\Where;
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

    public function getAllCartProducts ($ids) {
        // si aucun id le panier est vide alors on renvoi un array vide
        if (sizeof($ids) == 0)
            return array();
        $where = new Where();
        $where->in('id', $ids);

        $resultSet = $this->_tableGateway->select($where);
        $return = array();
        $ll = 'l';
        foreach( $resultSet as $r ) {
            $return[]=$r;
        }
        return $return;
    }
}
?>