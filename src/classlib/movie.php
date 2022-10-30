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

class Show {
    public $id;
    public $theatre;
    public $date;
    public $time;

    public function __construct($id, $theatre, $date, $time)
    {
        $this->id = $id;
        $this->theatre = $theatre;
        $this->date = $date;
        $this->time = $time;
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
    public $image;
    public $desc;
    public $releaseDate;
    public $rating;
    public $duration;
    public $trailer;
    public $genre;
    public $shows;

    public function __construct($id, $name, $image, $desc, $releaseDate, $rating, $duration, $trailer)
    {
        $this->id = $id;
        $this->name = $name;
        $this->image = $image;
        $this->desc = $desc;
        $this->releaseDate = $releaseDate;
        $this->rating = $rating;
        $this->duration = $duration;
        $this->trailer = $trailer;
        $this->genre = array();
        $this->shows = array();


    }
}

class MovieRepo {

    public $conn;

    public function __construct($conn)
    {
        $this->conn = $conn;
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
                        "./image.php?id=$id",
                        $row["desc"],
                        $row["releaseDate"],
                        $row["rating"],
                        $row["duration"],
                        $row["trailer"],
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
                    $show = new Show($row["showId"], $theatre, $date, $time);
                    $movieTable[$row["movieId"]]->shows[$row["showId"]] = $show;
                }
            }
            return $movieTable;
        } else {
            return array();
        }
    }


}
