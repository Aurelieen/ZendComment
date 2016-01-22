<?php

namespace Livre\Model;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class UserTable {
    protected $tableGateway;
    
    public function __construct(TableGateway $tableGateway) {
        $this->tableGateway = $tableGateway;
    }
    
    public function getUser($id) {
        $id = (int) $id;
        
        $select = new Select();
        $select->from('utilisateur');
        $select->where('id_utilisateur = "' . $id . '"');
        
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;
    }
    
    public function fetchOthers($id) {
        $id = (int) $id;
        
        $select = new Select();
        $select->from('utilisateur');
        $select->where('id_utilisateur <> ' . $id);
        
        $resultSet = $this->tableGateway->selectWith($select);
        return $resultSet;       
    }
}

