<?php

class Events {

    public $eventName;

    public function __construct() {
    }

    public function getEventsArray() {
        global $mysqli_cms;

        $query = $mysqli_cms->query("SELECT * FROM events ORDER BY id DESC");
        $result = $query->fetch_all(MYSQLI_ASSOC);
        return $result;
    }

    public function getEventIdAsName($eventID) {
        switch ($eventID) {
            case '1':
                $this->eventName = 'Christmas';
                break;
            case '2':
                $this->eventName = "New Years Eve";
                break;
        }
        return $this->eventName;
    }

    public function getEventFromID($eventID) {
        global $mysqli_cms;

        $query = $mysqli_cms->query("SELECT * FROM events WHERE id='$eventID'");
        $result = $query->fetch_assoc();
        return $result;
    }

    public function saveEvent($id, $activated) {
        global $mysqli_cms;

        $result = $mysqli_cms->query("UPDATE events SET activated='$activated' WHERE id='$id'");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

}
