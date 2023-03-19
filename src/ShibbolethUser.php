<?php

namespace Vojir\ShibbolethAuthenticator;

/**
 * Class ShibbolethUser
 * @package ShibbolethAuthExtension
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class ShibbolethUser{
  public string $username='';
  public string $displayName='';
  public string $email='';
  public ?string $sessionId=null;
  public string $givenName='';
  public string $familyName='';
  public string $personId='';
  public array $roles = [];
  public array $memberOf = [];


  /**
   * ShibbolethUser constructor.
   * @param string $username
   * @param string $displayName
   * @param string $email
   * @param string|null $sessionId
   * @param string $givenName
   * @param string $familyName
   * @param string $personId
   * @param array $roles
   * @param array $memberOf
   */
  public function __construct(string $username='', string $displayName='', string $email='', ?string $sessionId=null, string $givenName='', string $familyName='', string $personId='', array $roles = [], array $memberOf = []){
    $this->username=$username;
    $this->displayName=$displayName;
    $this->email=$email;
    $this->sessionId=$sessionId;
    $this->givenName=$givenName;
    $this->familyName=$familyName;
    $this->personId=$personId;
    $this->roles=$roles;
    $this->memberOf=$memberOf;
  }
}