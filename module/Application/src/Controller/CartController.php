<?php

namespace Application\Controller;

use Application\Model\Product;
use Application\Services\CartTable;
use User\Services\PrivilegeManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;
use Application\Model\CartItem;
use Application\Services\AuctionTable;
use Application\Form\AuctionEditForm;
use Zend\View\Model\ViewModel;

class CartController extends AbstractActionController
{
    private $_table;
    private $_cartTable;

    public function __construct(AuctionTable $table, CartTable $cartTable)
    {
        $this->_table = $table;
        $this->_cartTable = $cartTable;
    }



    public function cartAction()
    {
        $cartProductsIds = $this->_cartTable->getUserCart();
        return new ViewModel([
            'products' => $this->_table->getAllCartProducts($cartProductsIds),
        ]);
    }

    public function addtocartAction()
    {
        {
            $id = (int)$this->params()->fromRoute('id', -1);
            if ($id < 1) {
                $this->getResponse()->setStatusCode(404);
                return;
            }

            $product = $this->_table->find($id);

            if ($product == null) {
                $this->getResponse()->setStatusCode(404);

                return;
            }

            $form = new AuctionEditForm($product);

            if ($this->getRequest()->isPost()) {
                $data = [
                    'idProduct' => $id,
                    'username' => $_SESSION['username'], 1
                ];
                $cartItem = new CartItem();
                $cartItem->exchangeArray($data);
                $this->_cartTable->insert($cartItem);

                return $this->redirect()->toRoute('cart');
            }

            return new ViewModel(array(
                'product' => $product,
                'form' => $form
            ));
        }


    }

    public function removefromcartAction()
    {
        {
            $id = (int)$this->params()->fromRoute('id', -1);
            if ($id < 1) {
                $this->getResponse()->setStatusCode(404);
                return;
            }

            $product = $this->_table->find($id);

            if ($product == null) {
                $this->getResponse()->setStatusCode(404);

                return;
            }

            $form = new AuctionEditForm($product);

            if ($this->getRequest()->isPost()) {
                $data = [
                    'idProduct' => $id,
                    'username' => $_SESSION['username'], 1
                ];
                $cartItem = new CartItem();
                $cartItem->exchangeArray($data);
                $this->_cartTable->delete($cartItem);

                return $this->redirect()->toRoute('cart');
            }

            return new ViewModel(array(
                'product' => $product,
                'form' => $form
            ));
        }
    }

    public function paycartAction()
    {


        $form = new AuctionEditForm(new Product());

        $success = rand(0, 1);
        if ($this->getRequest()->isPost()) {
            if ($success) {
                $this->_cartTable->payCart();
            } else {
                echo 'mdr fail';
            }

        }

        return new ViewModel(array(
            'success' => $success,
            'orderId' => $this->generateOrderId(),
            'form' => $form
        ));

    }

    function generateOrderId($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

?>