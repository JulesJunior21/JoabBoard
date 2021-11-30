<?php
    $method = $_SERVER["REQUEST_METHOD"];


    switch($method)
	{
		case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_comp($id);
			}
			else
			{
				get_comps();
			}
			break;

		case 'POST':
			insert_comp();
			break;

		case 'DELETE':
			$id = intval($_GET['id']);
			delete_comp($id);
			break;
		case 'PUT':
			$id = intval($_GET['id']);
			update_comp($id);
			break;
		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
	}

    function get_comp($id) {

        require_once "../../bootstrap.php";

        header('Content-Type: application/json');

        $response = $entityManager->find('Companies',$id);
		

        echo json_encode($response);
    }

    function get_comps() {

        require_once "../../bootstrap.php";

        header('Content-Type: application/json');

        $response = $entityManager->getRepository('Companies')->findAll();

        echo json_encode($response);

    }

    function insert_comp() {
        
        require_once "../../bootstrap.php";

		$data = json_decode(file_get_contents('php://input'), true);

        $company = new Companies();

        $company->name = $data['name'];

        $company->activity = $data['activity'];

        $company->description = $data['description'];

		$company->state = false;

		$company->email = $data['email'];

		$company->phone = $data['phone'];

		$address = new Address();

		$address->street = $data['street'];

        $address->city = $data['city'];

        $address->state = $data['state'];

        $address->postalcode = $data['postalcode'];

        $address->country = $data['country'];

        $company->address = $address;

		$entityManager->persist($company);

        $entityManager->flush();
    }

    function delete_comp($id) {

		require_once "../../bootstrap.php";

		$company = $entityManager->getRepository('Companies')->find($id);

		$entityManager->remove($company);

		$entityManager->flush();

    }

    function update_comp($id) {

		require_once "../../bootstrap.php";

		$data = json_decode(file_get_contents('php://input'), true);

		$company = $entityManager->getRepository('Companies')->find($id);

		$company->name = $data['name'] ? $data['name'] : $company->name;

        $company->activity = $data['activity'] ? $data['activity'] : $company->activity;

        $company->description = $data['description'] ? $data['description'] : $company->description;

		$company->state = $data['state'] ? $data['state'] : $company->state;

		$company->email = $data['email'] ? $data['email'] : $company->email;

		$company->phone = $data['phone'] ? $data['phone'] : $company->phone;

		$entityManager->persist($company);

        $entityManager->flush();

    }

?>