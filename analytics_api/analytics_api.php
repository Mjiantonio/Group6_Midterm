<?php

require_once '../event.php';
require_once '../participant.php';
require_once '../registration.php';
require_once '../database.php';

header("Content-Type: application/json");


$database = new Database();
$db = $database->getConnection();

$event = new Event($db);
$participant = new Participant($db);
$reg = new Registration($db);

$method = $_SERVER['REQUEST_METHOD'];

if ($method === 'GET') {
    if (isset($_GET['participants_per_event'])) {
     $participant_per_event = $event->getParticipantsCountPerEvent();
        if ($participant_per_event && count($participant_per_event) > 0) {
        echo json_encode($participant_per_event);
        } else {
        echo json_encode(["message" => "No Events Listed."]);
        }   
    }
    elseif (isset($_GET['most_popular'])) {
     $most_popular = $event->getMostPopularEvent();
        if ($most_popular && count($most_popular) > 0) {
        echo json_encode($most_popular);
        } else {
        echo json_encode(["message" => "No Events Listed."]);
        }   
    }
    elseif (isset($_GET['total_reg'])) {
     $total_reg = $reg->getTotalRegistrations();
        if ($total_reg && count($total_reg) > 0) {
        echo json_encode($total_reg);
        } else {
        echo json_encode(["message" => "No Events Listed."]);
        }   
    }
}
