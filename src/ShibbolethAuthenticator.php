<?php

namespace Vojir\ShibbolethAuthenticator;

/**
 * Class ShibbolethAuthenticator - simple authenticator using Shibboleth server variables
 * @package ShibbolethAuthExtension
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class ShibbolethAuthenticator{

  public $config=[
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
      'shibSessionId'=>'',
      'givenName'=>'',
      'familyName'=>'',
      'personId'=>''
    ]
  ];

  /**
   * Method returning URL for login
   * @param string $targetUrl
   * @return string
   */
  public function getLoginUrl($targetUrl=''){
    $url=$this->config['URLs']['sessionInitiator'];
    if ($targetUrl!=''){
      $url.=(strpos($url,'?')?'&':'?').'target='.$targetUrl;
    }
    return $url;
  }

  /**
   * Method returning URL for login
   * @param string $targetUrl
   * @return string
   */
  public function getLogoutUrl($targetUrl=''){
    $url=$this->config['URLs']['sessionInitiator'];
    if ($targetUrl!=''){
      $url.=(strpos($url,'?')?'&':'?').'target='.$targetUrl;
    }
    return $url;
  }

  /**
   * @return string
   */
  public function getPasswordChangeUrl(){
    return $this->config['URLs']['passwordChange'];
  }

  /**
   * @return string
   */
  public function getPasswordResetUrl(){
    return $this->config['URLs']['passwordReset'];
  }

  /**
   * @return bool
   */
  public function isLoggedIn(){
    return ($this->getServerVariable('shibSessionId') && $this->getServerVariable('username'));
  }

  /**
   * @return ShibbolethUser|null
   */
  public function getUser(){
    if ($this->isLoggedIn()){
      return new ShibbolethUser(
        $this->getServerVariable('username'),
        $this->getServerVariable('displayName'),
        $this->getServerVariable('email'),
        $this->getServerVariable('shibSessionId'),
        $this->getServerVariable('givenName'),
        $this->getServerVariable('familyName'),
        $this->getServerVariable('personId')
      );
    }else{
      return null;
    }
  }

  /**
   * Metoda vracející hodnotu proměnné z $_SERVER dle konfigu tohoto rozšíření
   * @param string $name
   * @return string|null
   */
  private function getServerVariable($name){
    if (isset($_SERVER[$this->config['variables'][$name]])){
      return $_SERVER[$this->config['variables'][$name]];
    }else{
      return null;
    }
  }
}