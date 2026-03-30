<?php
header("Content-Type: application/json");
include_once '../database.php';
include_once '../registration.php';

$database = new Database();
$db = $database->getConnection();
$registration = new Registration($db);

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->event_id) && !empty($data->participant_id)){
    $registration->event_id = $data->event_id;
    $registration->participant_id = $data->participant_id;

    if($registration->create()){
        http_response_code(201);
        echo json_encode(["message" => "Relationship created: Participant linked to event."]);
    } else {
        http_response_code(503);
        echo json_encode(["message" => "Unable to create relationship."]);
    }
} else {
    http_response_code(400);
    echo json_encode(["message" => "Incomplete data. Provide event_id and participant_id."]);
}