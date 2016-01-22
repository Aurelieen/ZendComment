<?php
namespace Livre\Model;

class User {
    public $id_utilisateur;
    public $login_utilisateur;
    
    public function exchangeArray($data) {
        $this->id_utilisateur = (!empty($data['id_utilisateur'])) ? $data['id_utilisateur'] : null;
        $this->login_utilisateur = (!empty($data['login_utilisateur'])) ? $data['login_utilisateur'] : null;
    }
}
