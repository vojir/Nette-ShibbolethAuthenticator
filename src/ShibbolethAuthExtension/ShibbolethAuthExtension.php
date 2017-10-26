<?php

namespace ShibbolethAuthExtension;

use Nette;

/**
 * Class ShibbolethAuthExtension
 * @package ShibbolethAuthExtension
 * @author Stanislav Vojíř
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

}