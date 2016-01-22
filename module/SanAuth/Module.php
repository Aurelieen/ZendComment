<?php
namespace SanAuth;
use SanAuth\Controller;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Authentication\Storage;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;

class Module implements AutoloaderProviderInterface {
    public function getConfig() {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getAutoloaderConfig() {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig() {
        return array(
            'factories' => array(
                'SanAuth\Model\MyAuthStorage' => function($sm) {
            return new \SanAuth\Model\MyAuthStorage('zf_tutorial');
        },
                'AuthService' => function($sm) {
            
            $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
            $dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter, 'utilisateur', 'login_utilisateur', 'mdp_utilisateur', 'MD5(?)');
            $authService = new AuthenticationService();
            $authService->setAdapter($dbTableAuthAdapter);
            $authService->setStorage($sm->get('SanAuth\Model\MyAuthStorage'));
            return $authService;
        },
            ),
        );
    }
}