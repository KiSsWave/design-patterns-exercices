<?php
require('../vendor/autoload.php');

use App\Factory\VehicleFactory;


$vehicleFactory = new VehicleFactory();


echo "Création de véhicules avec la première méthode de la factory :\n";
$bicycle = $vehicleFactory->createVehicle('bicycle', 0.1, 'humain');
$car = $vehicleFactory->createVehicle('car', 1.5, 'essence');
$truck = $vehicleFactory->createVehicle('truck', 2.5, 'diesel');

echo "Vélo - Coût par km : " . $bicycle->getCostPerKm() . ", Type de carburant : " . $bicycle->getFuelType() . "\n";
echo "Voiture - Coût par km : " . $car->getCostPerKm() . ", Type de carburant : " . $car->getFuelType() . "\n";
echo "Camion - Coût par km : " . $truck->getCostPerKm() . ", Type de carburant : " . $truck->getFuelType() . "\n";


echo "\nCréation de véhicules basés sur les paramètres du trajet :\n";

$scenarios = [
    ['distance' => 10, 'weight' => 10, 'description' => 'Courte distance, charge légère'],
    ['distance' => 25, 'weight' => 10, 'description' => 'Longue distance, charge légère'],
    ['distance' => 5, 'weight' => 30, 'description' => 'Courte distance, charge moyenne'],
    ['distance' => 100, 'weight' => 250, 'description' => 'Longue distance, charge lourde']
];

foreach ($scenarios as $scenario) {
    $vehicle = $vehicleFactory->createVehicleForJourney($scenario['distance'], $scenario['weight']);
    $type = get_class($vehicle);
    $type = substr($type, strrpos($type, '\\') + 1);

    echo "Scénario : " . $scenario['description'] . "\n";
    echo "  Distance : " . $scenario['distance'] . "km, Poids : " . $scenario['weight'] . "kg\n";
    echo "  Véhicule sélectionné : " . $type . "\n";
    echo "  Coût par km : " . $vehicle->getCostPerKm() . ", Type de carburant : " . $vehicle->getFuelType() . "\n";
    echo "\n";
}