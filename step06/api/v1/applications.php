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
        
        case 'PUT' :
            update_app($_GET["id"]);
            break;
        case 'DELETE':
            delete_app($_GET['id']);
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

        $app->message = $data['message'];

        $app->status = false;

        $entityManager->persist($app);

        $entityManager->flush();
    }

    function update_app($id) {
        require_once "../../bootstrap.php";

        $data = json_decode(file_get_contents('php://input'), true);

        $app = $entityManager->getRepository('Applications')->find($id);

        $app->status = $data["status"] ? $data["status"] : $app->status ;

        $entityManager->persist($app);

        $entityManager->flush();

        echo "Application n°: " . $app->id . " accepted !"; 
    }

    function delete_app($id) {
        require_once "../../bootstrap.php";

        $app = $entityManager->getRepository('Applications')->find($id);

        $entityManager->remove($app);

        $entityManager->flush();

        echo "Application n°: " . $id . " successfully deleted!";

    }
?>