<?php
namespace Application\Model;

class CartItem {
    public $_idProduct;
    public $_username;

    public function __construct(){

    }

    // Fonction appelé automatiquement pour convertir les données de la BD vers un objet de type Auction
    public function exchangeArray($data) {
        $this->_idProduct = (!empty($data['idProduct'])) ? $data['idProduct'] : null;
        $this->_username = (!empty($data['username'])) ? $data['username'] : null;
    }

    // Converti le model vers un tableau associatif
    public function toValues(){
        return [
            'idProduct' => $this->_idProduct,
            'username' => $this->_username,
        ];
    }
}
?>