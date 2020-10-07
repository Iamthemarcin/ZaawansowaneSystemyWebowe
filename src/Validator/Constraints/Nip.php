<?php


namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class Nip extends Constraint
{

    public $message = 'Wprowadź poprawny numer NIP';
}