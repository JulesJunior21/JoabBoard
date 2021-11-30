<?php
    include "bootstrap.php";

    if(isset($_GET['id'])) {
        $response = $entityManager->getRepository('Companies')->find($_GET['id']);
    }

    echo json_encode($response);
?>