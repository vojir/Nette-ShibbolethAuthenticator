<?php

namespace Vojir\ShibbolethAuthenticator;

/**
 * Class ShibbolethAuthenticator - simple authenticator using Shibboleth server variables
 * @package ShibbolethAuthExtension
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class ShibbolethAuthenticator{

  public array $config=[
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
      'personId'=>'',
      'affiliation'=>'',
      'affiliationRoles'=>[],
      'memberOf'=>''
    ]
  ];

  /**
   * Method returning URL for login
   * @param string $targetUrl
   * @return string
   */
  public function getLoginUrl($targetUrl=''):string{
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
  public function getLogoutUrl($targetUrl=''):string{
    $url=$this->config['URLs']['sessionLogout'];
    if ($targetUrl!=''){
      $url.=(strpos($url,'?')?'&':'?').'return='.$targetUrl;
    }
    return $url;
  }

  /**
   * @return string
   */
  public function getPasswordChangeUrl():string{
    return $this->config['URLs']['passwordChange'];
  }

  /**
   * @return string
   */
  public function getPasswordResetUrl():string{
    return $this->config['URLs']['passwordReset'];
  }

  /**
   * @return bool
   */
  public function isLoggedIn():bool{
    return ($this->getServerVariable('shibSessionId') && $this->getServerVariable('username'));
  }

  /**
   * @return ShibbolethUser|null
   */
  public function getUser():?ShibbolethUser{
    if ($this->isLoggedIn()){
      return new ShibbolethUser(
        $this->getServerVariable('username') ?? '',
        $this->getServerVariable('displayName') ?? '',
        $this->getServerVariable('email',true) ?? '',
        $this->getServerVariable('shibSessionId'),
        $this->getServerVariable('givenName') ?? '',
        $this->getServerVariable('familyName') ?? '',
        $this->getServerVariable('personId') ?? '',
        $this->getAffiliationRoles(),
        (($roles = $this->getServerVariable('memberOf')) ? explode(';', $roles) : [])
      );
    }else{
      return null;
    }
  }

  /**
   * Metoda vracející hodnotu proměnné z $_SERVER dle konfigu tohoto rozšíření
   * @param string $name
   * @param bool $returnSingleValue = false
   * @return string|null
   */
  private function getServerVariable(string $name,bool $returnSingleValue=false):?string{
    if (isset($this->config['variables'][$name]) && isset($_SERVER[$this->config['variables'][$name]])){
      $value=$_SERVER[$this->config['variables'][$name]];
      if ($returnSingleValue && strpos($value,';')){
        $valueArr=explode(';',trim($value,';'));
        if (is_array($valueArr)){
          $value=array_shift($valueArr);
        }
      }
      return $value;
    }else{
      return null;
    }
  }

  /**
   * Metoda vracející seznam namapovaných rolí
   * @return array
   */
  private function getAffiliationRoles():array{
    $result=[];
    if (!empty($this->config['variables']['affiliationRoles']) && is_array($this->config['variables']['affiliationRoles'])){
      $affiliationRoles = $this->config['variables']['affiliationRoles'];
      $affiliation = explode(';', $this->getServerVariable('affiliation') ?? '');

      foreach ($affiliationRoles as $role=>$affiliationRole){
        if (in_array($affiliationRole,$affiliation)){
          $result[]=$role;
        }
      }
    }
    return $result;
  }
}
