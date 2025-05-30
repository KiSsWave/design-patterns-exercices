<?php

namespace App;

use SplObserver;
use SplSubject;

class User implements SplObserver
{
    // Hors exercice mais notable:
    // Promotion du constructeur: https://www.php.net/manual/fr/language.oop5.decon.php#language.oop5.decon.constructor.promotion
    public function __construct(
        private string $name,
        private bool $notified = false
    ) {}

    public function getName(): string
    {
        return $this->name;
    }

    public function isNotified(): bool
    {
        return $this->notified;
    }

    public function update(SplSubject $subject): void
    {
        if ($subject instanceof MusicBand) {
            $this->notified = true;
        }
    }
}