<?php

use Symfony\Component\Console\Application;

$method = $method = $_SERVER["REQUEST_METHOD"];

    switch($method)
    {
        case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_app($id);
			}
			else
			{
				get_apps();
			}
			break;

		case 'POST':
			insert_app();
			break;

		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
    }

    function get_app($id) {

        require_once "../../bootstrap.php";

        header('Content-Type: application/json');

        $response = $entityManager->find('Applications',$id);

        echo json_encode($response);
    }

    function get_apps() {
        
        require_once "../../bootstrap.php";

        header('Content-Type: application/json');

        $response = $entityManager->getRepository("Applications")->findAll();

        echo json_encode($response);
    }

    function insert_app() {

        require_once "../../bootstrap.php";

        $data = json_decode(file_get_contents('php://input'), true);

        $app = new Applications();

        $applyant  = $entityManager->find("Users", $data["applyant"]);

        $advertisements = $entityManager->find("Advertisements", $data["advertisement"]);

        $app->setAdvertisements($advertisements);

        $app->setApplyant($applyant);

        $app->date = new DateTime();

        $entityManager->persist($app);

        $entityManager->flush();
    }
?>