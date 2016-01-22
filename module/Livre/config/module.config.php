<?php
 return array(
     // Gérer la liste des contrôleurs
     'controllers' => array(
         'invokables' => array(
             'Livre\Controller\Livre' => 'Livre\Controller\LivreController',
         ),
     ),
     
     // Gérer les routes du livre
     'router' => array(
         'routes' => array(
             'livre' => array(
                 'type'    => 'segment',
                 'options' => array(
                     'route'    => '/livre[/:action][/:idl][/:id]',
                     'constraints' => array(
                         'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
                         'idl' => '[0-9]+',
                         'id'     => '[0-9]+',
                     ),
                     'defaults' => array(
                         'controller' => 'Livre\Controller\Livre',
                         'action'     => 'index'
                     ),
                 ),
             ),
         ),
     ),
     
     // Gérer l'appel à la vue
     'view_manager' => array(
         'template_path_stack' => array(
             'livre' => __DIR__ . '/../view',
         ),
     ),
 );