<?php
header("Content-Type: application/json");
include_once '../database.php';
include_once '../event.php';

$database = new Database();
$db = $database->getConnection();
$event = new Event($db);

$stmt = $event->getParticipantsPerEvent();
$num = $stmt->rowCount();

if($num > 0){
    $events_arr = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $event_item = array(
            "event_name" => $event_name,
            "total_participants" => (int)$total_participants
        );
        array_push($events_arr, $event_item);
    }
    http_response_code(200);
    echo json_encode($events_arr);
} else {
    echo json_encode(["message" => "No relationships found."]);
}