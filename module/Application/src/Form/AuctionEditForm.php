<?php
namespace Application\Form;

use Zend\Form\Form;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilter;
use Application\Model\Product;

/**
 * This form is used to collect user's login, password and 'Remember Me' flag.
 */
class AuctionEditForm extends Form
{
    private $_auction;
    public function __construct(Product $elem)
    {
        $this->_auction = $elem;

        // Define form name
        parent::__construct('auctionedit-form');
     
        // Set POST method for this form
        $this->setAttribute('method', 'post');
        
        $this->addElements();
        
    }
    

    protected function addElements() 
    {
        $this->add([            
            'type'  => 'text',
            'name' => 'name',
            'options' => [
                'label' => 'Nom',
            ],
        ]);
        
        $this->add([            
            'type'  => 'text',
            'name' => 'description',
            'options' => [
                'label' => 'Description',
            ],
        ]);
        
        $this->add([            
            'type'  => 'number',
            'name' => 'price',
            'options' => [
                'label' => 'Prix',
            ],
        ]);


        
        $this->add([
            'type'  => 'submit',
            'name' => 'submit',
            'attributes' => [                
                'value' => 'Sign in',
                'id' => 'submit',
            ],
        ]);
    }      
}

