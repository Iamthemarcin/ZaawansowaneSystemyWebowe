<?php

namespace App\Communication;

use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class Message implements MessageInterface
{
  private FlashBagInterface $flashBag;
  private TranslatorInterface $translator;

  public function __construct(
    FlashBagInterface $flashBag,
    TranslatorInterface $translator
  ){
      $this->flashBag = $flashBag;
      $this->translator = $translator;
  }

  public function addSuccess(string $translationKey, array $parameters = [], $domain = null, $locale = null): void
  {
      $this->flashBag->add(
          self::TYPE_SUCCESS,
          $this->translator->trans($translationKey, $parameters, $domain, $locale)
      );
  }

  public function addError(string $translationKey, array $parameters = [], $domain = null, $locale = null): void
  {
      $this->flashBag->add(
          self::TYPE_ERROR,
          $this->translator->trans($translationKey, $parameters, $domain, $locale)
      );
  }

  public function addWaring(string $translationKey, array $parameters = [], $domain = null, $locale = null): void
  {
      $this->flashBag->add(
          self::TYPE_WARING,
          $this->translator->trans($translationKey, $parameters, $domain, $locale)
      );
  }

  public function addInfo(string $translationKey, array $parameters = [], $domain = null, $locale = null): void
  {
      $this->flashBag->add(
          self::TYPE_INFO,
          $this->translator->trans($translationKey, $parameters, $domain, $locale)
      );
  }
}
