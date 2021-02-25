<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
require_once '../config/database.php';
require_once '../objects/person.php';
$database = new Database;
$db = $database->getConnection();

$person = new Person($db);

$stmt = $person->read();
$num = $stmt->rowCount();

if ($num > 0) {
    $persons_arr = [];
    $persons_arr['records'] = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        array_push($persons_arr['records'], $row);
    }
    http_response_code(200);
    echo json_encode($persons_arr);
} else {
    http_response_code(404);
    echo json_encode(['message' => 'No Person Found']);
}
