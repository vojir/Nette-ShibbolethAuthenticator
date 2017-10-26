<?php

namespace Vojir\ShibbolethAuthExtension\DI;

/**
 * Class ShibbolethAuthExtension
 * @package ShibbolethAuthExtension
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class ShibbolethAuthExtension extends Nette\DI\CompilerExtension{

  /**
   * @param Nette\Configurator $configurator
   * @param string $prefix = 'shibboleth'
   */
  public static function register(Nette\Configurator $configurator, $prefix = 'shibboleth'){
    $class = __CLASS__;
    $configurator->onCompile[] = function ($configurator, $compiler) use ($prefix, $class) {
      $compiler->addExtension($prefix, new $class);
    };
  }

  public function loadConfiguration(){
    $container = $this->getContainerBuilder();
    $container->addDefinition($this->prefix('shibboleth'))
      ->setClass('Vojir\\ShibbolethAuthenticator\\ShibbolethAuthenticator');
  }

}