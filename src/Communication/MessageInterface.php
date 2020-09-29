<?php

namespace App\Communication;

interface MessageInterface
{
    public const TYPE_SUCCESS = 'success';
    public const TYPE_ERROR = 'danger';
    public const TYPE_WARING = 'warning';
    public const TYPE_INFO = 'info';

    public function addSuccess(string $translationKey, array $parameters = [], $domain = null, $locale = null): void;
    public function addError(string $translationKey, array $parameters = [], $domain = null, $locale = null): void;
    public function addWaring(string $translationKey, array $parameters = [], $domain = null, $locale = null): void;
    public function addInfo(string $translationKey, array $parameters = [], $domain = null, $locale = null): void;
}
