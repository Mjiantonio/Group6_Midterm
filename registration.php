<?php
class Registration {
    private $conn;
    private $table_name = "registrations";

    public $registration_id;
    public $event_id;
    public $participant_id;
    public $registration_date;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (event_id, participant_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute([$this->event_id, $this->participant_id]);
    }

    public function getTotalRegistrations() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}