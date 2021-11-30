<?php

    $method = $_SERVER["REQUEST_METHOD"];


    switch($method)
	{
		case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_ad($id);
			}
			else
			{
				get_ads();
			}
			break;

		case 'POST':
			insert_ad();
			break;

		case 'DELETE':
			$id = intval($_GET['id']);
			delete_ad($id);
			break;
		case 'PUT':
			$id = intval($_GET['id']);
			update_ad($id);
			break;
		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}


    function get_ad($id) {

        require_once "../../bootstrap.php";

        header('Content-Type: application/json');

       $response = $entityManager->find('Advertisements',$id);

        echo json_encode($response);

    }

    function get_ads() {

        require_once "../../bootstrap.php";

        header('Content-Type: application/json');
        $response = $entityManager->getRepository('Advertisements')->findAll();

        echo json_encode($response);
    }

	function insert_ad() {

		require_once "../../bootstrap.php";

		$data = json_decode(file_get_contents('php://input'), true);

		$ad = new Advertisements();

		$ad->title = $data['title'];

		$ad->description = $data['description'];

		$ad->salary = $data['salary'];

		$ad->duration = $data['duration'];

		$ad->responsabilities = $data['responsabilities'];

		$ad->requirements = $data['requirements'];

		$ad->state = false;

		$ad->objectives = $data['objectives'];

		$ad->creatAt = new DateTime();

		$ad->modifiedAt = new DateTime();

		$companies = $entityManager->getRepository('Companies')->find($data['company']);
		$companies->addAdvertisements($ad);
		
		$entityManager->persist($ad);

		$entityManager->flush();

		echo "Advertisements " . $ad->id . " added!";
	}


	function delete_ad($id) {

		require_once "../../bootstrap.php";

		$advertisements = $entityManager->getRepository('Advertisements')->find($id);

		$entityManager->remove($advertisements);

		$entityManager->flush();
	}

	function update_ad($id) {
		
		require_once "../../bootstrap.php";

		$data = json_decode(file_get_contents('php://input'), true);

		$ad = $entityManager->getRepository('Advertisements')->find($id);

		$ad->title = $data['title'] ? $data['title'] : $ad->title;

		$ad->description = $data['description'] ? $data['description'] : $ad->description;

		$ad->salary = $data['salary'] ? $data['salary'] : $ad->salary;

		$ad->duration = $data['duration'] ? $data['duration'] : $ad->duration;

		$ad->responsabilities = $data['responsabilities'] ? $data['responsabilities'] : $ad->responsabilities;

		$ad->requirements = $data['requirements'] ? $data['requirements'] : $ad->requirements;

		$ad->state = $data['state'] ? $data['state'] : $ad->state;

		$ad->objectives = $data['objectives'] ? $data['objectives'] : $ad->objectives;

		$ad->modifiedAt = new DateTime();

		$companies = $entityManager->getRepository('Companies')->find($data['company'] ? $data['company'] : $companies->id);

		$ad->setCompany($companies);

		$entityManager->persist($ad);

		$entityManager->flush();

		echo "Advertisements " . $ad->id . "modified!";
	}

?>