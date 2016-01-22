<?php
    namespace Livre\Form;
    use Zend\Form\Form;
    
    class LivreForm extends Form {
        public function __construct($name = null) {
            parent::__construct('livre');
            
            $this->add(array(
             'name' => 'id_message',
             'type' => 'Hidden',
            ));

            $this->add(array(
             'name' => 'id_livre',
             'type' => 'Hidden',
            ));
            
            $this->add(array(
                'name' => 'contenu',
                'type' => 'Textarea',
                'options' => array(
                    'label' => 'Message ',
                ),
            ));
            
            $this->add(array(
                'name' => 'submit',
                'type' => 'Submit',
                'attributes' => array(
                    'value' => 'Valider',
                    'id' => 'submitbutton',
                ),
            ));
        }
    }
