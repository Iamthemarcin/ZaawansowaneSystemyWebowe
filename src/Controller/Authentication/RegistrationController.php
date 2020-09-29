<?php

namespace App\Controller\Authentication;

use App\Entity\User\User;
use App\Form\Authorization\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
  private EmailVerifier $emailVerifier;
  private TranslatorInterface $translator;
  private EntityManagerInterface $em;
  
  public function __construct(
    EmailVerifier $emailVerifier,
    TranslatorInterface $translator,
    EntityManagerInterface $em
  ){
    $this->emailVerifier = $emailVerifier;
    $this->translator = $translator;
    $this->em = $em;
  }
  
  public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
  {
    $user = new User();
    $form = $this->createForm(RegistrationFormType::class, $user);
    $form->handleRequest($request);
    
    if ($form->isSubmitted() && $form->isValid()) {
      $user->setPassword(
        $passwordEncoder->encodePassword(
          $user,
          $form->get('plainPassword')->getData()
        )
      );
      
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($user);
      $entityManager->flush();
      
      $this->emailVerifier->sendEmailConfirmation('verify_email', $user,
        (new TemplatedEmail())
          ->from(new Address('no-reply@dev-effectivity.pl', 'Nazwa Projektu'))
          ->to($user->getEmail())
          ->subject('Please Confirm your Email')
          ->htmlTemplate('emails/registration/confirmation_email.html.twig')
      );
  
      $this->addFlash('success', $this->translator->trans('register.sent_activation_mail'));
      
      return $this->redirectToRoute('login');
    }
    
    return $this->render('security/register.html.twig', [
      'registrationForm' => $form->createView(),
    ]);
  }
  
  public function verifyUserEmail(Request $request): Response
  {
    $id = $request->query->get('id');
    $user = $this->em->getRepository(User::class)->find($id);

    try {
      $this->emailVerifier->handleEmailConfirmation($request, $user);
    } catch (VerifyEmailExceptionInterface $exception) {
      $this->addFlash('verify_email_error', $exception->getReason());

      return $this->redirectToRoute('register');
    }

    $this->addFlash('success', $this->translator->trans('register.verified_mail'));

    return $this->redirectToRoute('login');
  }
}
