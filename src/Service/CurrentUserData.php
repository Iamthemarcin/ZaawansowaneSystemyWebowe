<?php


namespace App\Service;


use App\Entity\User\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class CurrentUserData
{
	private TokenStorageInterface $token;
	
	public function __construct(
		TokenStorageInterface $token
	){
		$this->token = $token;
	}
	
	public function getUser(): ?User
	{
		/** @var User $user */
		$user = $this->token->getToken()->getUser();
		if (false === $user instanceof User) {
			return null;
		}
		
		return $user;
	}
}