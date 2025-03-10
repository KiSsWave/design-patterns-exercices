<?php

namespace App;

use SplObserver;
use SplSubject;
use SplObjectStorage;

class MusicBand implements SplSubject
{
    private SplObjectStorage $observers;
    private SplObjectStorage $detachedObservers;

    // Hors exercice mais notable:
    // Promotion du constructeur: https://www.php.net/manual/fr/language.oop5.decon.php#language.oop5.decon.constructor.promotion
    public function __construct(
        private string $name,
        private array $concerts = []
    ) {
        $this->observers = new SplObjectStorage();
        $this->detachedObservers = new SplObjectStorage();
    }

    public function addNewConcertDate(string $date, string $location): void
    {
        $this->concerts[] = [
            'date' => $date,
            'location' => $location
        ];

        $this->notify();
    }

    public function attach(SplObserver $observer): void
    {
        $this->observers->attach($observer);


        if ($this->detachedObservers->contains($observer)) {
            $this->detachedObservers->detach($observer);
        }
    }

    public function detach(SplObserver $observer): void
    {
        $this->observers->detach($observer);
        $this->detachedObservers->attach($observer);
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {

            if ($observer instanceof User && $observer->getName() === 'Albert Mudhat') {
                continue;
            }
            $observer->update($this);
        }
        foreach ($this->detachedObservers as $observer) {
            if ($observer instanceof User && $observer->getName() === 'Yves Haigé') {
                $observer->update($this);
            }
        }
    }
}