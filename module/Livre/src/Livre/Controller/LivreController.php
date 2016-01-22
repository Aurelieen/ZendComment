<?php

namespace Livre\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Livre\Form\LivreForm;
use Livre\Model\Livre;

class LivreController extends AbstractActionController {

    protected $livreTable;
    protected $userTable;

    // Récupérer la liste des messages sur le /livre
    public function indexAction() {
        $perso = $this->getServiceLocator()->get('AuthService')->getIdentity();
        $this->getLivreTable()->setServiceManager($this->getServiceLocator());

        $id = (int) $this->params()->fromRoute('idl', $perso['id']);
        return new ViewModel(array(
            'livres' => $this->getLivreTable()->fetchMoi($id),
            'infos' => $perso,
            'id_page' => $id,
            'user_exists' => $this->getLivreTable()->userExists($id),
            'user' => $this->getUserTable()->getUser($id),
            'others' => $this->getUserTable()->fetchOthers($id),
        ));
    }

    // Ajouter un message
    public function addAction() {
        $form = new LivreForm();
        $form->get('submit')->setValue('Envoyer le message');
        
        $perso = $this->getServiceLocator()->get('AuthService')->getIdentity();
        $id = (int) $this->params()->fromRoute('idl', $perso['id']);
        
        if ($this->getLivreTable()->userExists($id)) {
            // Prise en compte de la requête
            $request = $this->getRequest();
            if ($request->isPost()) {
                $message = new Livre();
                $form->setInputFilter($message->getInputFilter());
                $form->setData($request->getPost());

                if ($form->isValid()) {
                    $message->exchangeArray($form->getData());
                    $message->date_message = new \Zend\Db\Sql\Expression("NOW()");
                    $message->id_livre = $id;
                    $message->id_utilisateur = $perso['id'];

                    print_r($message);
                    $this->getLivreTable()->saveLivre($message);

                     // Redirect to list of albums
                    return $this->redirect()->toRoute('livre');
                }
            }

            return array('form' => $form);
        } else {
            return "Aucun livre d'or n'est disponible à cette adresse.";
        }
    }

    // Éditer les messages qu'on a écrits
    public function editAction() {
        $id = (int) $this->params()->fromRoute('idl', 0);
        if (!$id) {
            return $this->redirect()->toRoute('livre', array(
                'action' => 'index'
            ));
        }
        
        try {
            $message = $this->getLivreTable()->getLivre($id);
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('livre', array(
                'action' => 'index'
            ));
        }
        
        $perso = $this->getServiceLocator()->get('AuthService')->getIdentity();
        if ($perso['id'] != $message->id_livre && $perso['id'] != $message->id_utilisateur) {
            return $this->redirect()->toRoute('livre', array(
                'action' => 'index'
            ));    
        }

        $form  = new LivreForm();
        $form->bind($message);
        $form->get('submit')->setAttribute('value', 'Éditer votre message');
        
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($message->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getLivreTable()->saveLivre($message);

                // Rediriger vers sa liste de messages
                return $this->redirect()->toRoute('livre', array('action' => 'index'));
            }
        }

        return array('id' => $id, 'form' => $form,);
    }

    // Supprimer les messages qu'on a écrits ou qui ont été postés sur son mur
    public function deleteAction() {
        $id = (int) $this->params()->fromRoute('idl', 0);
        if (!$id) {
            return $this->redirect()->toRoute('livre');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');
                $this->getLivreTable()->deleteLivre($id);
            }

            // Redirect to list of albums
            return $this->redirect()->toRoute('livre');
        }

        return array(
            'id'    => $id,
            'livre' => $this->getLivreTable()->getLivre($id)
        );
    }

    public function getLivreTable() {
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
