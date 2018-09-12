<?php

namespace Vojir\ShibbolethAuthenticator\DI;

use Nette;
use Vojir\ShibbolethAuthenticator\ShibbolethAuthenticator;

/**
 * Class ShibbolethAuthExtension
 * @package ShibbolethAuthExtension
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class ShibbolethAuthExtension extends Nette\DI\CompilerExtension{

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
    Nette\Utils\Validators::assert($config['URLs']['sessionInitiator'], 'url', 'URLs.sessionInitiator');
    Nette\Utils\Validators::assert($config['URLs']['sessionLogout'], 'url', 'URLs.sessionLogout');
    Nette\Utils\Validators::assert($config['variables']['username'], 'string', 'variables.username');
    Nette\Utils\Validators::assert($config['variables']['email'], 'string', 'variables.email');
    Nette\Utils\Validators::assert($config['variables']['displayName'], 'string', 'variables.displayName');
    Nette\Utils\Validators::assert($config['variables']['shibSessionId'], 'string', 'variables.shibSessionId');

    $container = $this->getContainerBuilder();
    $container->addDefinition($this->prefix('shibboleth'))
      ->setType('Vojir\\ShibbolethAuthenticator\\ShibbolethAuthenticator')
      ->addSetup('$config',[$config]);
  }

  public static function register(Nette\Configurator $configurator){
    $configurator->onCompile[] = function ($config, Nette\DI\Compiler $compiler) {
      $compiler->addExtension('shibboleth', new ShibbolethAuthExtension());
    };
  }

}