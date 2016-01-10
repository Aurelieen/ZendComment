<?php
 return array(
     'db' => array(
         'driver'         => 'Pdo',
         'dsn'            => 'mysql:dbname=test;host=localhost',
         'driver_options' => array(
             PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''
         ),
     ),
     'service_manager' => array(
         'factories' => array(
             'Zend\Db\Adapter\Adapter'
                     => 'Zend\Db\Adapter\AdapterServiceFactory',
             'Zend\Log\Logger' => function($sm) {
        $logger = new Zend\Log\Logger;
        // $writer = new Zend\Log\Writer\Stream('F:/logs/zend' . date('Y-m-d') . '-error.log');
         $writer = new Zend\Log\Writer\Stream('./data/logs/logfile');
        $filter = new Zend\Log\Filter\Priority(Zend\Log\Logger::INFO);
        $writer->addFilter($filter);
        $logger->addWriter($writer);
        return $logger;
    }
         ),
     ),
 );