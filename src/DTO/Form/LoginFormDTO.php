<?php

namespace App\DTO\Form;

class LoginFormDTO
{
  private $email;
  private $password;
  
  /**
   * @return mixed
   */
  public function getEmail()
  {
    return $this->email;
  }
  
  /**
   * @param string $email
   *
   * @return LoginFormDTO
   */
  public function setEmail(string $email): LoginFormDTO
  {
    $this->email = $email;
    
    return $this;
  }
  
  /**
   * @return mixed
   */
  public function getPassword()
  {
    return $this->password;
  }
  
  /**
   * @param string $password
   *
   * @return LoginFormDTO
   */
  public function setPassword(string $password): LoginFormDTO
  {
    $this->password = $password;
    
    return $this;
  }
  
}