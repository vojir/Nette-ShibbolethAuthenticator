<?php

namespace Vojir\ShibbolethAuthenticator\DI;

use Vojir\ShibbolethAuthenticator\ShibbolethAuthenticator;
use Nette\Utils\Validators;

/**
 * Class ShibbolethAuthExtension
 * @package ShibbolethAuthExtension
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class ShibbolethAuthExtension extends \Nette\DI\CompilerExtension{

  private $defaults = [
    'URLs'=>[
      'sessionInitiator'=>'',
      'sessionLogout'=>'',
      'passwordChange'=>'',
      'passwordReset'=>''
    ],
    'variables'=>[
      'username'=>'',
      'email'=>'',
      'displayName'=>'',
      'shibSessionId'=>''
    ]
  ];

  public function loadConfiguration(){
    $config=$this->validateConfig($this->defaults);
    Validators::assert($config['URLs']['sessionInitiator'], 'url', 'URLs.sessionInitiator');
    Validators::assert($config['URLs']['sessionLogout'], 'url', 'URLs.sessionLogout');
    Validators::assert($config['variables']['username'], 'string', 'variables.username');
    Validators::assert($config['variables']['email'], 'string', 'variables.email');
    Validators::assert($config['variables']['displayName'], 'string', 'variables.displayName');
    Validators::assert($config['variables']['shibSessionId'], 'string', 'variables.shibSessionId');

    $container = $this->getContainerBuilder();
    $container->addDefinition($this->prefix('shibboleth'))
      ->setType('Vojir\\ShibbolethAuthenticator\\ShibbolethAuthenticator')
      ->addSetup('$config',[$config]);
  }

  public static function register(\Nette\Configurator $configurator){
    $configurator->onCompile[] = function ($config, \Nette\DI\Compiler $compiler) {
      $compiler->addExtension('shibboleth', new ShibbolethAuthExtension());
    };
  }

}