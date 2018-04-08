<?php
namespace Application\Model;

class Product {
    public $_id;
    public $_name;
    public $_price;
    public $_description;

    public function __construct(){

    }

    // Fonction appelé automatiquement pour convertir les données de la BD vers un objet de type Auction
    public function exchangeArray($data) { 
        $this->_id = (!empty($data['id'])) ? $data['id'] : null;
        $this->_name = (!empty($data['name'])) ? $data['name'] : null;
        $this->_price = (!empty($data['price'])) ? $data['price'] : null;
        $this->_description = (!empty($data['description'])) ? $data['description'] : null;
    }

    // Converti le model vers un tableau associatif
    public function toValues(){
        return [
            'id' => $this->_id,
            'name' => $this->_name,
            'price' => $this->_price,
            'description' => $this->_description,
        ];
    }
}
?>