<?php

namespace Livre\Model;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;
 

class Livre implements InputFilterAwareInterface {
    public $id_message;
    public $id_livre;
    public $id_utilisateur;
    public $login_utilisateur;
    public $posteur;
    public $contenu;
    public $date_message;

    protected $inputFilter;
    
    public function exchangeArray($data) {
        $this->id_message = (!empty($data['id_message'])) ? $data['id_message'] : null;
        $this->id_livre = (!empty($data['id_livre'])) ? $data['id_livre'] : null;
        $this->id_utilisateur = (!empty($data['id_utilisateur'])) ? $data['id_utilisateur'] : null;
        $this->contenu = (!empty($data['contenu'])) ? $data['contenu'] : null;
        $this->date_message = (!empty($data['date_message'])) ? $data['date_message'] : null;
        $this->posteur = (!empty($data['posteur'])) ? $data['posteur'] : null;
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();
            
            $inputFilter->add(array(
                'name'     => 'contenu',
                'required' => true,
                'filters'  => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name'    => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min'      => 1,
                            'max'      => 240,
                        ),
                    ),
                ),
            ));
            
            $this->inputFilter = $inputFilter;
        }
        
        return $this->inputFilter;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Non utilisé ici.");
    }
    
    public function getArrayCopy() {
        return get_object_vars($this);
    }
}
