<?php


namespace App\DTO\Form;


use phpDocumentor\Reflection\Types\Boolean;

class ProjectAddDTO
{
private $domain;
private $client;
private $type;
private $status;

/**
 * @return mixed
 */
public function  getDomain(){
    return $this->domain;
}
/**
 * @param string $domain
 *
 * @return  ProjectAddDTO
 */
public function setDomain(string $domain):ProjectAddDTO
{
 $this->domain=$domain;
 return  $this;
}

/**
 * @return mixed
 */
public function  getClient(){
    return $this->client;
}
/**
 * @param string $client
 *
 * @return  ProjectAddDTO
 */
public function setClient(string $client):ProjectAddDTO
{
    $this->client=$client;
    return  $this;
}

/**
 * @return mixed
 */
public function  getType(){
    return $this->type;
}
/**
 * @param string $type
 *
 * @return  ProjectAddDTO
 */
public function setType(string $type):ProjectAddDTO
{
    $this->type=$type;
    return  $this;
}

/**
 * @return mixed
 */
public function  getStatus(){
    return $this->status;
}
/**
 * @param boolean $status
 *
 * @return  ProjectAddDTO
 */
public function setStatus(Boolean $status):ProjectAddDTO
{
    $this->status=$status;
    return  $this;
}

}