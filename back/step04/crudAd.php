<?php
    require_once 'bootstrap.php';
    
    header('Content-Type: application/json');

    if (isset($_GET['id'])) {
        if($_GET['id'] == "all") {
            $response1 = $entityManager->getRepository('Advertisements')->findAll();

            echo json_encode($response1);
        }
    }
?>