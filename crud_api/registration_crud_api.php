<?php
// api.php

require_once '../models/registrations.php';
require_once '../models/database.php';

header("Content-Type: application/json");


$database = new Database();
$db = $database->getConnection();

$reg = new Registration($db);

$method = $_SERVER['REQUEST_METHOD'];

$id = isset($_GET['id']) ? $_GET['id'] : null;

$input = json_decode(file_get_contents("php://input"), true);


if ($method === 'POST') {

    if (empty($input['participant_id'])) {
        echo json_encode(["message" => "Participant ID is required"]);
        exit;
    }

    if (empty($input['event_id'])) {
        echo json_encode(["message" => "Event ID is required"]);
        exit;
    }

    $participant->participant_name = $input['participant_id'];
    $participant->event_id = $input['event_id'];

    $created = $reg->create();

    if ($created) {
        echo json_encode([
            "message" => "Participant created"
        ]);
    } else {
        echo json_encode(["message" => "Failed to create registration"]);
    }
}