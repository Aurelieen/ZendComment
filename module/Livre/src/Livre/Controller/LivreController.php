<?php

 namespace Livre\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;

 class LivreController extends AbstractActionController
 {
     protected $livreTable;
     protected $userTable;
     
     public function indexAction()
     {
         $perso = $this->getServiceLocator()->get('AuthService')->getIdentity();
         $this->getLivreTable()->setServiceManager($this->getServiceLocator());
         
         $id = (int) $this->params()->fromRoute('idl', $perso['id']);
         
         return new ViewModel(array(
             'livres' => $this->getLivreTable()->fetchMoi($id),
             'infos' => $perso,
             'id_page' => $id,
             'user_exists' => $this->getLivreTable()->userExists($id),
             'user' => $this->getUserTable()->getUser($id),
         ));
     }

     public function addAction()
     {
     }

     public function editAction()
     {
     }

     public function deleteAction()
     {
     }
     
    public function getLivreTable()
    {
         if (!$this->livreTable) {
             $sm = $this->getServiceLocator();
             $this->livreTable = $sm->get('Livre\Model\LivreTable');
         }
         return $this->livreTable;
    }
    
    public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('Livre\Model\UserTable');
        }
        
        return $this->userTable;
    }
 }