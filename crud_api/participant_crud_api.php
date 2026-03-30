<?php
// api.php

require_once '../participant.php';
require_once '../database.php';

header("Content-Type: application/json");


$database = new Database();
$db = $database->getConnection();

$participant = new Participant($db);

$method = $_SERVER['REQUEST_METHOD'];

$id = isset($_GET['id']) ? $_GET['id'] : null;

$input = json_decode(file_get_contents("php://input"), true);


if ($method === 'POST') {

    if (empty($input['participant_name'])) {
        echo json_encode(["message" => "Participant name is required"]);
        exit;
    }

    if (empty($input['event_id'])) {
        echo json_encode(["message" => "Event ID is required"]);
        exit;
    }

    $participant->participant_name = $input['participant_name'];
    $participant->event_id = $input['event_id'];

    $created = $participant->create();

    if ($created) {
        echo json_encode([
            "message" => "Participant created"
        ]);
    } else {
        echo json_encode(["message" => "Failed to create participant"]);
    }
}


elseif ($method === 'GET') {

  $allParticipants = $participant->read();

    if ($allParticipants && count($allParticipants) > 0) {
        echo json_encode($allEvents);
    } else {
        echo json_encode(["message" => "No Events Listed."]);
    }
}

