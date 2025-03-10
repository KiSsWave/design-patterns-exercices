<?php
require('../vendor/autoload.php');

use App\Config;


$config1 = Config::getInstance();


echo "Configuration de la base de données :\n";
echo "- Hôte : " . $config1->get('db.host') . "\n";
echo "- Utilisateur : " . $config1->get('db.user') . "\n";
echo "- Base de données : " . $config1->get('db.name') . "\n\n";

echo "Mode debug : " . ($config1->get('debug') ? 'Activé' : 'Désactivé') . "\n";
echo "Clé API : " . $config1->get('apiKey') . "\n\n";


$config2 = Config::getInstance();


echo "Les deux instances sont-elles identiques ? ";
echo ($config1 === $config2 ? "Oui" : "Non") . "\n";


echo "\nDémonstration supplémentaire :\n";
echo "Configuration avant modification :\n";
echo "- Mode debug (config1) : " . ($config1->get('debug') ? 'Activé' : 'Désactivé') . "\n";
echo "- Mode debug (config2) : " . ($config2->get('debug') ? 'Activé' : 'Désactivé') . "\n";


$reflection = new ReflectionObject($config1);
$property = $reflection->getProperty('settings');
$property->setAccessible(true);
$settings = $property->getValue($config1);
$settings['debug'] = false;
$property->setValue($config1, $settings);

echo "Configuration après modification :\n";
echo "- Mode debug (config1) : " . ($config1->get('debug') ? 'Activé' : 'Désactivé') . "\n";
echo "- Mode debug (config2) : " . ($config2->get('debug') ? 'Activé' : 'Désactivé') . "\n";