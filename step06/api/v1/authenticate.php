<?php
$requestMethod = $_SERVER['REQUEST_METHOD'];

require_once("../../bootstrap.php");

switch ($requestMethod) {
    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);

        if (isset($data)) {

            $result = $entityManager->getRepository("Users")->findOneBy(["email" => $data['email'], "password" => $data['password']]);

            if (isset($result)) {

                require_once "../../jwt.php";

                $exp = time() + 3600;

                $payload = [
                    "userId" => $result->id,
                    "userType" => $result->type,
                    "userName" => $result->$firstname,
                    "exp" => $exp
                ];



                $serverKey = '5f2b5cdbe5194f10b3241568fe4e2b24';

                $token = JWT::encode($payload, $serverKey);


                $returnArray = array('token' => $token, 'usertype' => $result->type);
                $jsonEncodedReturnArray = json_encode($returnArray, JSON_PRETTY_PRINT);
                echo $jsonEncodedReturnArray;
            } else {
                $returnArray = array('error' => 'Invalid user ID or password.');
                $jsonEncodedReturnArray = json_encode($returnArray, JSON_PRETTY_PRINT);
                echo $jsonEncodedReturnArray;
            }
        }
        break;
    case 'GET':
        $token = null;

        if (isset($_GET['token'])) {
            $token = $_GET['token'];
        }

        if (!is_null($token)) {

            require_once('../../jwt.php');

            $serverKey = '5f2b5cdbe5194f10b3241568fe4e2b24';

            try {
                $payload = JWT::decode($token, $serverKey, array('HS256'));
                $returnArray = array('userId' => $payload->userId);
                if (isset($payload->exp)) {
                    $returnArray['exp'] = date(DateTime::ISO8601, $payload->exp);;
                }
            } catch (Exception $e) {
                $returnArray = array('error' => $e->getMessage());
            }
        } else {
            $returnArray = array('error' => 'You are not logged in with a valid token.');
        }

        $jsonEncodedReturnArray = json_encode($returnArray, JSON_PRETTY_PRINT);
        echo $jsonEncodedReturnArray;
        break;
}
