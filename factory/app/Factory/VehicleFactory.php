<?php

namespace App\Factory;

use App\Entity\VehicleInterface;
use App\Entity\Bicycle;
use App\Entity\Car;
use App\Entity\Truck;

class VehicleFactory
{

    public function createVehicle(string $type, float $costPerKm, string $fuelType): VehicleInterface
    {
        switch (strtolower($type)) {
            case 'bicycle':
                return new Bicycle($costPerKm, $fuelType);
            case 'car':
                return new Car($costPerKm, $fuelType);
            case 'truck':
                return new Truck($costPerKm, $fuelType);
            default:
                throw new \InvalidArgumentException("Type de véhicule invalide: $type");
        }
    }


    public function createVehicleForJourney(float $distance, float $weight): VehicleInterface
    {
        if ($weight > 200) {
            return $this->createVehicle('truck', 2.5, 'diesel');
        } elseif ($weight > 20) {
            return $this->createVehicle('car', 1.5, 'essence');
        } elseif ($distance < 20) {
            return $this->createVehicle('bicycle', 0.1, 'humain');
        } else {
            return $this->createVehicle('car', 1.5, 'essence');
        }
    }
}