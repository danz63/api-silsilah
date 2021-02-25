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

$person->person_id = $_POST['person_id'];
if ($person->delete()) {
    http_response_code(201);
    echo json_encode(['message' => 'Person Data was Deleted']);
} else {
    http_response_code(503);
    echo json_encode(['message' => 'Unable To Delete Person Data']);
}
