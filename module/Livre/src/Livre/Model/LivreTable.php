<?php

namespace Livre\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class LivreTable implements \Zend\ServiceManager\ServiceManagerAwareInterface {

    protected $tableGateway;
    protected $serviceManager;

    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }

    public function fetchAll() {
        $resultSet = $this->tableGateway->select();
        return $resultSet;
    }

    // Ajoutée pour récupérer uniquement les messages postés dans son livre
    public function fetchMoi($id) {
        $select = new Select();
        $select->from(array('m' => 'message'))
               ->join(array('l' => 'livre_d_or'), 'm.id_livre = l.id_livre')
               ->join(array('u' => 'utilisateur'), 'm.id_utilisateur = u.id_utilisateur', array('posteur' => 'login_utilisateur'));
        $select->where('m.id_livre = "' . $id . '"');

        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }

    public function getLivre($id) {
        $id = (int) $id;
        
        $rowset = $this->tableGateway->select(array('id_message' => $id));
        $row = $rowset->current();
        if (!$row) {
            throw new \Exception("Could not find row $id");
        }
        return $row;
    }

    public function saveLivre(Livre $livre) {
        $data = array(
            'contenu' => $livre->contenu,
        );

        $id = (int) $livre->id_message;
        if ($id == 0) {
            $this->tableGateway->insert($data);
        } else {
            if ($this->getLivre($id)) {
                $this->tableGateway->update($data, array('id_message' => $id));
            } else {
                throw new \Exception('Ce livre n\'existe pas');
            }
        }
    }

    public function deleteLivre($id) {
        $this->tableGateway->delete(array('id_message' => (int) $id));
    }

    // Vérifie que l'utilisateur existe dans la base de données
    public function userExists($id) {
        //Check that the username is not present in the database

        $dbAdapter = $this->serviceManager->get('Zend\Db\Adapter\Adapter');
        $validator = new \Zend\Validator\Db\RecordExists(
                array(
            'table' => 'utilisateur',
            'field' => 'id_utilisateur',
            'adapter' => $dbAdapter,
                )
        );

        return ($validator->isValid($id));
    }

    // Récupère les informations d'un utilisateur
    public function userDetails($id) {
        
    }
    
    public function setServiceManager(\Zend\ServiceManager\ServiceManager $serviceManager) {
        $this->serviceManager = $serviceManager;
        return $this;
    }

}
