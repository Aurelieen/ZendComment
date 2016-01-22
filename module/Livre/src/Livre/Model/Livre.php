<?php
 
namespace Livre\Model;

 class Livre
 {
     public $id_message;
     public $id_livre;
     public $id_utilisateur;
     public $login_utilisateur;
     public $posteur;
     public $contenu;
     public $date_message;

     public function exchangeArray($data)
     {
         $this->id_message = (!empty($data['id_message'])) ? $data['id_message'] : null;
         $this->id_livre = (!empty($data['id_livre'])) ? $data['id_livre'] : null;
         $this->id_utilisateur = (!empty($data['id_utilisateur'])) ? $data['id_utilisateur'] : null;
         $this->contenu = (!empty($data['contenu'])) ? $data['contenu'] : null;
         $this->date_message = (!empty($data['date_message'])) ? $data['date_message'] : null;
         $this->posteur= (!empty($data['posteur'])) ? $data['posteur'] : null;
     }
 }