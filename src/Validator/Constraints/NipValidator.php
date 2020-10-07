<?php


namespace App\Validator\Constraints;

use App\Communication\MessageInterface;
use Ddeboer\Vatin\Validator;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\ValidatorException;

class NipValidator extends ConstraintValidator
{
    /**
     * VATIN validator
     *
     * @var Validator
     */
    private Validator $validator;
    private MessageInterface $message;

    public function __construct (
        MessageInterface $message
    ){
        $this->message = $message;
        $this->validator = new Validator();
    }

    /** @inheritDoc */
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof Nip) {
            throw new UnexpectedTypeException($constraint, Nip::class);
        }
        try {
            if(!$this->validator->isValid('PL'.$value)) {
                $this->context->buildViolation($constraint->message)
                    ->setParameter('{{nip}}', $value)
                    ->addViolation();
                $this->message->addError('error.nip');
            }
        } catch(ValidatorException $e) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{nip}}', $value)
                ->addViolation();
        }
    }
}