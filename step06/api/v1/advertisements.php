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

        echo json_encode($response->json_serializer());

    }

    function get_ads() {

        require_once "../../bootstrap.php";

        header('Content-Type: application/json');

        $response = $entityManager->getRepository('Advertisements')->findAll();

		$response2 = [];

		foreach($response as $element) {
			array_push($response2 , $element->json_serializer());
		}

        echo json_encode($response2);
    }

	function insert_ad() {

		require_once "../../bootstrap.php";

		$data = json_decode(file_get_contents('php://input'), true);

		$ad = new Advertisements();

		$ad->title = $data['title'];

		$ad->description = $data['description'];

		$ad->content = $data['content'];

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

		echo "Addvertisement n° " . $id . " successfully deleted";

	}

	function update_ad($id) {
		
		require_once "../../bootstrap.php";

		$data = json_decode(file_get_contents('php://input'), true);

		$ad = $entityManager->getRepository('Advertisements')->find($id);

		$ad->title = $data['title'] ? $data['title'] : $ad->title;

		$ad->description = $data['description'] ? $data['description'] : $ad->description;

		$ad->content = $data['content'] ? $data['content'] : $ad->content;

		$ad->modifiedAt = new DateTime();

		$companies = $entityManager->getRepository('Companies')->find($data['company'] ? $data['company'] : $companies->id);

		$ad->setCompany($companies);

		$entityManager->persist($ad);

		$entityManager->flush();

		echo "Advertisements " . $ad->id . "modified!";
	}

?>