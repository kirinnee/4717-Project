<?php

class Genre {
    public $id;
    public $name;
    public $desc;

    public function __construct($id, $name, $desc)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
    }
}

class Seat {
    public $id;
    public $no;
    public $status;

    public function __construct($id, $no, $status)
    {
        $this->id = $id;
        $this->no = $no;
        $this->status = $status;
    }
}

class Show {
    public $id;
    public $theatre;
    public $date;
    public $time;
    public $seats;

    public function __construct($id, $theatre, $date, $time, $seats)
    {
        $this->id = $id;
        $this->theatre = $theatre;
        $this->date = $date;
        $this->time = $time;
        $this->seats = $seats;
    }
}

class Theatre {
    public $id;
    public $name;
    public $address;

    public function __construct($id, $name, $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->address = $address;
    }
}

class Movie {
    public $id;
    public $name;
    public $poster;
    public $image1;
    public $image2;
    public $desc;
    public $releaseDate;
    public $rating;
    public $duration;
    public $trailer;
    public $genre;
    public $shows;

    public function __construct($id, $name, $desc, $releaseDate, $rating, $duration, $trailer, $poster, $image1, $image2)
    {
        $this->id = $id;
        $this->name = $name;
        $this->desc = $desc;
        $this->releaseDate = $releaseDate;
        $this->rating = $rating;
        $this->duration = $duration;
        $this->trailer = $trailer;
        $this->poster = $poster;
        $this->image1 = $image1;
        $this->image2 = $image2;
        $this->genre = array();
        $this->shows = array();


    }
}

class GenreRepo {
    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function getAll()
    {
        $db = ($this->conn)();
        $r = $db->query("SELECT * FROM Genres");
        if($r) {
            $genre = array();
            while($row = $r->fetch_assoc()) {
                $genre[] = $row["name"];
            }
            return $genre;
        } else {
            return array();
        }
    }
}

class MovieRepo {

    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function get($id){
        $db = ($this->conn)();
        $r = $db->query("SELECT m.id as movieId, m.name as name, m.description as `desc`, m.release_date as releaseDate, m.rating as rating, m.duration as duration, m.trailer as trailer, g.name as genre, g.description as genreDesc, g.id as genreId, s.id as showId, s.show_time as showTime, t.id as theatreId, t.name as theatreName, t.address as theatreAddress, st.id as seatId, st.seat_no as seatNo, st.status as seatStatus FROM Movies as m JOIN MovieGenre as mg ON m.id = mg.movie_id JOIN Genres as g ON mg.genre_id = g.id JOIN Shows as s ON s.movie_id = m.id JOIN Theatres as t ON s.theatre_id = t.id JOIN Seats as st ON st.show_id = s.id WHERE m.id = '$id'");

        if($r) {
            $movieTable = array();
            while($row = $r->fetch_assoc()) {
                if(!isset($movieTable[$row["movieId"]])) {
                    $id = $row["movieId"];
                    $movieTable[$row["movieId"]] = new Movie(
                        $id,
                        $row["name"],
                        $row["desc"],
                        $row["releaseDate"],
                        $row["rating"],
                        $row["duration"],
                        $row["trailer"],
                        "./image.php?id=$id&type=poster",
                        "./image.php?id=$id&type=image1",
                        "./image.php?id=$id&type=image2",
                    );
                }
                if(!isset($movieTable[$row["movieId"]]->genre[$row["genreId"]])) {
                    $genre = new Genre($row["genreId"], $row["genre"], $row["genreDesc"]);
                    $movieTable[$row["movieId"]]->genre[$row["genreId"]] = $genre;
                }
                if(!isset($movieTable[$row["movieId"]]->shows[$row["showId"]])) {
                    $theatre = new Theatre($row["theatreId"], $row["theatreName"], $row["theatreAddress"]);
                    $timestamp = $row["showTime"];
                    $date = date('Y-m-d',strtotime($timestamp));
                    $time = date('H:i:s',strtotime($timestamp));
                    $show = new Show($row["showId"], $theatre, $date, $time, array());
                    $movieTable[$row["movieId"]]->shows[$row["showId"]] = $show;
                }
                $movieTable[$row["movieId"]]->shows[$row["showId"]]->seats[$row["seatId"]] = new Seat($row["seatId"],$row["seatNo"],$row["seatStatus"]);
            }
            $db->close();
            if(count($movieTable) === 0) {
                return null;
            }
            return $movieTable[$id];
        } else {
            return null;
        }
    }

    public function getAll()
    {
        $db = ($this->conn)();
        $r = $db->query("SELECT m.id as movieId, m.name as name, m.description as `desc`, m.release_date as releaseDate, m.rating as rating, m.duration as duration, m.trailer as trailer, g.name as genre, g.description as genreDesc, g.id as genreId, s.id as showId, s.show_time as showTime, t.id as theatreId, t.name as theatreName, t.address as theatreAddress FROM Movies as m JOIN MovieGenre as mg ON m.id = mg.movie_id JOIN Genres as g ON mg.genre_id = g.id JOIN Shows as s ON s.movie_id = m.id JOIN Theatres as t ON s.theatre_id = t.id");

        if($r) {
            $movieTable = array();
            while($row = $r->fetch_assoc()) {
                if(!isset($movieTable[$row["movieId"]])) {
                    $id = $row["movieId"];
                    $movieTable[$row["movieId"]] = new Movie(
                        $id,
                        $row["name"],
                        $row["desc"],
                        $row["releaseDate"],
                        $row["rating"],
                        $row["duration"],
                        $row["trailer"],
                        "./image.php?id=$id&type=poster",
                        "./image.php?id=$id&type=image1",
                        "./image.php?id=$id&type=image2",
                    );
                }
                if(!isset($movieTable[$row["movieId"]]->genre[$row["genreId"]])) {
                    $genre = new Genre($row["genreId"], $row["genre"], $row["genreDesc"]);
                    $movieTable[$row["movieId"]]->genre[$row["genreId"]] = $genre;
                }
                if(!isset($movieTable[$row["movieId"]]->shows[$row["showId"]])) {
                    $theatre = new Theatre($row["theatreId"], $row["theatreName"], $row["theatreAddress"]);
                    $timestamp = $row["showTime"];
                    $date = date('Y-m-d',strtotime($timestamp));
                    $time = date('H:i:s',strtotime($timestamp));
                    $show = new Show($row["showId"], $theatre, $date, $time, array());
                    $movieTable[$row["movieId"]]->shows[$row["showId"]] = $show;
                }
            }
            $db->close();
            return $movieTable;
        } else {
            return array();
        }
    }


}
