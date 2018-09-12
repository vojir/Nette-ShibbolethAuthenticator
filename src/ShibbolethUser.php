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

  /**
   * ShibbolethUser constructor.
   * @param string $username
   * @param string $displayName
   * @param string $email
   * @param null|string $sessionId
   */
  public function __construct($username='', $displayName='', $email='', $sessionId=null){
    $this->username=$username;
    $this->displayName=$displayName;
    $this->email=$email;
    $this->sessionId=$sessionId;
  }
}