<?php

class TicketType {
    public $id;
    public $name;
    public $cost;

    public function __construct($id, $name, $cost)
    {
        $this->id = $id;
        $this->name = $name;
        $this->cost = $cost;
    }
}

class TicketTypeRepo {
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll() {
        $db = ($this->conn)();
        $r = $db->query("SELECT * FROM TicketType");
        if($r) {
            $ticketTypes = [];
            while($row = $r->fetch_assoc()) {
                $ticketTypes[] = new TicketType($row['id'], $row['name'], $row['cost']);
            }
            return $ticketTypes;
        } else {
            return array();
        }
    }

}

?>
