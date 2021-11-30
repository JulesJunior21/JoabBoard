<?php
    $method = $method = $_SERVER["REQUEST_METHOD"];
    
    switch($method)
    {
        case 'GET':
			if(!empty($_GET["id"]))
			{
				$id=intval($_GET["id"]);
				get_user($id);
			}
			else
			{
				get_users();
			}
			break;

		case 'POST':
			insert_user();
			break;

		case 'DELETE':
			$id = intval($_GET['id']);
			delete_user($id);
			break;
		case 'PUT':
			$id = intval($_GET['id']);
			update_user($id);
			break;
		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
    }

    function get_user($id) {

        require_once "../../bootstrap.php";

        header('Content-Type: application/json');

        $response = $entityManager->find('Users',$id);
        

        echo json_encode($response);
    }

    function get_users() {

        require_once "../../bootstrap.php";

        header('Content-Type: application/json');
        $response = $entityManager->getRepository('Users')->findAll();

        echo json_encode($response);

    }

    function insert_user() {
        require_once "../../bootstrap.php";

		$data = json_decode(file_get_contents('php://input'), true);

        $user = new Users();

        $user->firstname = $data['firstname'];

        $user->lastname = $data['lastname'];

        $user->email = $data['email'];

        $user->phone = $data['phone'];

        $address = new Address();

        $address->street = $data['street'];

        $address->city = $data['city'];

        $address->state = $data['state'];

        $address->postalcode = $data['postalcode'];

        $address->country = $data['country'];

        $user->address = $address;

        $user->type = 1;

        $entityManager->persist($user);

        $entityManager->flush();

    }

    function delete_user($id) {

        require_once "../../bootstrap.php";

		$users = $entityManager->getRepository('Users')->find($id);

		$entityManager->remove($users);

		$entityManager->flush();

    }

    function update_user($id) {

        require_once "../../bootstrap.php";

        $data = json_decode(file_get_contents('php://input'), true);

        $user = $entityManager->getRepository('Users')->find($id);

        $user->firstname = $data['firstname'] ? $data['firstname'] : $user->firstname;

        $user->lastname = $data['lastname'] ? $data['lastname'] : $user->lastname;

        $user->email = $data['email'] ? $data['email'] : $user->email;

        $user->phone = $data['phone'] ? $data['phone'] : $user->phone;

        $entityManager->persist($user);

		$entityManager->flush();


    }

?>