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

class IndexController extends AbstractActionController
{
    private $_table;
    private $_cartTable;

    public function __construct(AuctionTable $table, CartTable $cartTable)
    {
        $this->_table = $table;
        $this->_cartTable = $cartTable;
    }

    public function indexAction()
    {
        return new ViewModel([
            'products' => $this->_table->fetchAll(),
        ]);
    }

    public function getUserPrivilege()
    {
    }

    public function editAction()
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
            $data = $this->params()->fromPost();

            $form->setData($data);
            $update = [
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
            ];
            $this->_table->update($product, $update);

            return $this->redirect()->toRoute('index');
        } else {
            $form->setData([
                'name' => $product->_name,
                'price' => $product->_price,
                'description' => $product->_description,
            ]);
        }

        return new ViewModel(array(
            'product' => $product,
            'form' => $form
        ));
    }

    public function deleteAction()
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

            $this->_table->delete($product);

            return $this->redirect()->toRoute('index');
        }

        return new ViewModel(array(
            'product' => $product,
            'form' => $form
        ));
    }

    public function createAction()
    {

        $product = new Product();
        $form = new AuctionEditForm($product);

        if ($this->getRequest()->isPost()) {
            $data = $this->params()->fromPost();
            $form->setData($data);
            $update = [
                'name' => $data['name'],
                'price' => $data['price'],
                'description' => $data['description'],
            ];
            $product->exchangeArray($update);
            $this->_table->insert($product);

            return $this->redirect()->toRoute('index');
        }

        return new ViewModel(array(
            'product' => $product,
            'form' => $form
        ));
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
                    'username' => $_SESSION['username'],1
                ];
                $cartItem = new CartItem();
                $cartItem->exchangeArray($data);
                $this->_cartTable->insert($cartItem);

                return $this->redirect()->toRoute('index');
            }

            return new ViewModel(array(
                'product' => $product,
                'form' => $form
            ));
        }

    }
}

?>