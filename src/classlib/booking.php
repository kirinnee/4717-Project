<?php

class Booking
{
    public $id;
    public $userId;
    public $theatreId;
    public $theatreName;
    public $theatreAdd;

    public $seatId;
    public $seatNo;

    public $movieId;
    public $movieName;

    public $showTime;

    public $timeStamp;

    public $uuid;

    public $ticketTypeId;
    public $ticketTypeName;

    /**
     * @param $id
     * @param $theatreId
     * @param $theatreName
     * @param $theatreAdd
     * @param $seatId
     * @param $seatNo
     * @param $movieId
     * @param $movieName
     * @param $showTime
     * @param $timeStamp
     * @param $uuid
     * @param $ticketTypeId
     * @param $ticketTypeName
     */
    public function __construct($id, $theatreId, $theatreName, $theatreAdd, $seatId, $seatNo, $movieId, $movieName, $showTime, $timeStamp, $uuid, $ticketTypeId, $ticketTypeName, $userId)
    {
        $this->id = $id;
        $this->theatreId = $theatreId;
        $this->theatreName = $theatreName;
        $this->theatreAdd = $theatreAdd;
        $this->seatId = $seatId;
        $this->seatNo = $seatNo;
        $this->movieId = $movieId;
        $this->movieName = $movieName;
        $this->showTime = $showTime;
        $this->timeStamp = $timeStamp;
        $this->uuid = $uuid;
        $this->ticketTypeId = $ticketTypeId;
        $this->ticketTypeName = $ticketTypeName;
        $this->userId = $userId;
    }


}

class BookingRepo
{
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get($id)
    {
        $db = ($this->conn)();
        $r = $db->query("SELECT b.user_id as userId, b.id as id, t.id as theatreId, t.name as theatreName, t.address as theatreAddress, s.id as seatId, s.seat_no as seatNo, m.id as movieId, m.name as movieName, sh.show_time as showTime, b.timestamp as timestamp, b.uuid as uuid, tt.id as ticketTypeId, tt.name as ticketTypeName FROM Booking as b JOIN Seats as s ON b.seat_id = s.id JOIN Shows as sh ON s.show_id = sh.id JOIN Movies as m ON m.id = sh.movie_id JOIN Theatres as t ON sh.theatre_id = t.id JOIN TicketType as tt ON tt.id = b.ticket_type WHERE b.id = '$id'");

        if (!$r) {
            return null;
        }
        $row = $r->fetch_assoc();
        if (!isset($row["id"])) return null;

        return new Booking($row["id"], $row["theatreId"], $row["theatreName"], $row["theatreAddress"], $row["seatId"], $row["seatNo"], $row["movieId"], $row["movieName"], $row["showTime"], $row["timestamp"], $row["uuid"], $row['ticketTypeId'], $row['ticketTypeName'], $row['userId']);
    }

    public function geByUserId($uid)
    {
        $db = ($this->conn)();
        $r = $db->query("SELECT b.user_id as userId, b.id as id, t.id as theatreId, t.name as theatreName, t.address as theatreAddress, s.id as seatId, s.seat_no as seatNo, m.id as movieId, m.name as movieName, sh.show_time as showTime, b.timestamp as timestamp, b.uuid as uuid, tt.id as ticketTypeId, tt.name as ticketTypeName FROM Booking as b JOIN Seats as s ON b.seat_id = s.id JOIN Shows as sh ON s.show_id = sh.id JOIN Movies as m ON m.id = sh.movie_id JOIN Theatres as t ON sh.theatre_id = t.id JOIN TicketType as tt ON tt.id = b.ticket_type WHERE b.user_id = '$uid'");

        $ret = array();
        if (!$r) {
            return $ret;
        }
        while ($row = $r->fetch_assoc()) {
            $ret[] = new Booking($row["id"], $row["theatreId"], $row["theatreName"], $row["theatreAddress"], $row["seatId"], $row["seatNo"], $row["movieId"], $row["movieName"], $row["showTime"], $row["timestamp"], $row["uuid"], $row['ticketTypeId'], $row['ticketTypeName'], $row['userId']);
        }
        return $ret;
    }
}

?>
