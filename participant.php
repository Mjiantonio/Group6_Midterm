<?php
class Participant {
    private $conn;
    private $table_name = "participants";

    public $participant_id;
    public $event_id;
    public $participant_name;

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
    $query = "INSERT INTO " . $this->table_name . " (participant_name, event_id) VALUES (?, ?)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute([
            $this->participant_name,
            $this->event_id
        ]);
    }

}