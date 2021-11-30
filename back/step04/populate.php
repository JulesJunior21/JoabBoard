<?php

use Symfony\Component\Console\Application;

include_once "./bootstrap.php";

    $app = new Applications();

    $app->date = new DateTime();

    $applyant = $entityManager->find("Users", 1);

    $app->applyant = $applyant;

    $entityManager->persist($applyant);

    $add = $entityManager->find("Advertisements", 1);

    $app->advertisements = $add;

    $entityManager->persist($add);
    
    $entityManager->persist($app);

    $entityManager->flush();
?>