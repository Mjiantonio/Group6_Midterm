<?php
class Event {
    private $conn;
    private $table_name = "events";

    public $event_id;
    public $event_name;
    public $event_date;
    public $event_address;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (event_name, event_date, event_address) VALUES (?, ?, ?)";
        
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->event_name, $this->event_date, $this->event_address]);
    }

    public function getParticipantsPerEvent() {
        $query = "SELECT e.event_name, COUNT(r.registration_id) as total_participants 
                  FROM " . $this->table_name . " e 
                  JOIN registrations r ON e.event_id = r.event_id 
                  GROUP BY e.event_id";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    public function getParticipantsCountPerEvent() {
    $query = "
        SELECT   e.event_name, COUNT(p.participant_id) AS total_participants
        FROM " . $this->table_name . " e
        LEFT JOIN participants p ON e.event_id = p.event_id
        GROUP BY e.event_id
        ORDER BY total_participants DESC
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getMostPopularEvent() {
    $query = "
        SELECT   e.event_name, COUNT(p.participant_id) AS total_participants
        FROM " . $this->table_name . " e
        LEFT JOIN participants p ON e.event_id = p.event_id
        GROUP BY e.event_id
        ORDER BY total_participants DESC
        LIMIT 1
    ";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
