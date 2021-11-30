<?php

    $method = $method = $_SERVER["REQUEST_METHOD"];

    if($method == 'PUT') {
        require_once "../../bootstrap.php";

        $data = json_decode(file_get_contents('php://input'), true);

        $address = $entityManager->getRepository("Address")->find($_GET["id"]);

        $address->street = $data['street'] ? $data['street'] : $address->street;

        $address->city = $data['city'] ? $data['city'] : $address->city;

        $address->state = $data['state'] ? $data['state'] : $address->state;

        $address->postalcode = $data['postalcode'] ? $data['postalcode'] : $address->postalcode;

        $address->country = $data['country'] ? $data['country'] : $address->country;

        $entityManager->persist($address);

        $entityManager->flush();

        echo "Address successfully modified!";
        
    }

?>