<?php
require('../vendor/autoload.php');

use App\MySQLQueryBuilder;
use App\LitteralBuilder;

$mysqlBuilder = new MySQLQueryBuilder();
$query = $mysqlBuilder
    ->select('id, nom, prenom, email')
    ->from('utilisateurs')
    ->where('age > 18')
    ->andWhere('ville = "Paris"')
    ->build();

echo "Requête MySQL :\n";
echo $query . "\n\n";


$literalBuilder = new LitteralBuilder();
$literalQuery = $literalBuilder
    ->select('id, nom, prenom, email')
    ->from('utilisateurs')
    ->where('âge supérieur à 18')
    ->orWhere('ville égale à "Paris"')
    ->build();

echo "Requête en français :\n";
echo $literalQuery . "\n\n";

