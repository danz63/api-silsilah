<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// get database connection
include_once '../config/database.php';

// instantiate product object
include_once '../objects/person.php';

$database = new Database();
$db = $database->getConnection();

$person = new Person($db);

$cond = !empty($_POST['person_id']) && !empty($_POST['name']) && !empty($_POST['gender']);
if ($cond) {
    $person->person_id = $_POST['person_id'];
    $person->name = $_POST['name'];
    $person->gender = $_POST['gender'];
    if (!empty($_POST['parent_id'])) {
        $person->parent_id = $_POST['parent_id'];
    }

    if ($person->update()) {
        http_response_code(201);
        echo json_encode(['message' => 'Person Data was Updated']);
    } else {
        http_response_code(503);
        echo json_encode(['message' => 'Unable To Update Person Data']);
    }
} else {
    http_response_code(400);
    echo json_encode(['message' => 'Unable To Update Person Data, Data is not Complete']);
}
