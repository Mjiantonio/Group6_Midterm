<?php
// api.php

require_once '../event.php';
require_once '../database.php';

header("Content-Type: application/json");


$database = new Database();
$db = $database->getConnection();

$event = new Event($db);

$method = $_SERVER['REQUEST_METHOD'];

$id = isset($_GET['id']) ? $_GET['id'] : null;

$input = json_decode(file_get_contents("php://input"), true);


if ($method === 'POST') {

    if (!isset($input['event_name']) || empty($input['event_name'])) {
        echo json_encode(["message" => "Event name is required"]);
        exit; 
    }
    if (!isset($input['event_date']) || empty($input['event_date'])) {
            echo json_encode(["message" => "Event date is required"]);
            exit;    
    }
    if (!isset($input['event_address']) || empty($input['event_address'])) {
        json_encode(["message" => "Event address is required"]);
        exit;
    }

    $event->event_name = $input['event_name'];
    $event->event_date = $input['event_date'];
    $event->event_address = $input['event_address'];

    $eventcreate = $event->create();
    if ($eventcreate) {
        echo json_encode([
            "message" => "Event created",
        ]);
    } else {
        echo json_encode(["message" => "Failed to create event"]);
    }
}


elseif ($method === 'GET') {

  $allEvents = $event->read();

    if ($allEvents && count($allEvents) > 0) {
        echo json_encode($allEvents);
    } else {
        echo json_encode(["message" => "No Events Listed."]);
    }
}

