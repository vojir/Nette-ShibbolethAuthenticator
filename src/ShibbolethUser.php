<?php

namespace Vojir\ShibbolethAuthenticator;

/**
 * Class ShibbolethUser
 * @package ShibbolethAuthExtension
 * @author Stanislav Vojíř
 * @license http://www.apache.org/licenses/LICENSE-2.0 Apache License, Version 2.0
 */
class ShibbolethUser{
  /** @var string $username */
  public $username='';
  /** @var string $displayName */
  public $displayName='';
  /** @var string $email */
  public $email='';
  /** @var null|string $sessionId */
  public $sessionId=null;
  /** @var string $givenName */
  public $givenName='';
  /** @var string $familyName */
  public $familyName='';
  /** @var string $personId */
  public $personId='';

  /**
   * ShibbolethUser constructor.
   * @param string $username
   * @param string $displayName
   * @param string $email
   * @param null|string $sessionId
   * @param string $givenName
   * @param string $familyName
   * @param string $personId
   */
  public function __construct($username='', $displayName='', $email='', $sessionId=null, $givenName='', $familyName='', $personId=''){
    $this->username=$username;
    $this->displayName=$displayName;
    $this->email=$email;
    $this->sessionId=$sessionId;
    $this->givenName=$givenName;
    $this->familyName=$familyName;
    $this->personId=$personId;
  }
}