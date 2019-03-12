<?php

class Polls {

    public $activePollID;
    public $YesVotes;
    public $NoVotes;

    public function __construct() {
        global $mysqli_cms;

        $query = "SELECT * FROM polls ORDER BY id DESC LIMIT 1";
        $result = $mysqli_cms->query($query);
        $fetch = $result->fetch_assoc();
        $this->activePollID = $fetch['id'];
        $this->YesVotes = $fetch['yes'];
        $this->NoVotes = $fetch['no'];
    }

    public function displayPopup() {
        global $mysqli_cms;


    }

    public function displayActivePoll() {
        global $mysqli_cms;

        $query = "SELECT * FROM polls ORDER BY id DESC LIMIT 1";
        $result = $mysqli_cms->query($query);
        $fetch = $result->fetch_assoc();
        return $fetch['question'];
    }

    public function checkIfHasVoted() {
        global $mysqli_cms;
        $ip = $_SERVER['REMOTE_ADDR'];

        $query = "SELECT * FROM poll_votes WHERE ip = '$ip'";
        $result = $mysqli_cms->query($query);
        $num = $result->num_rows;
        if ($num > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function voteYes() {
        global $mysqli_cms;

        $ip = $_SERVER['REMOTE_ADDR'];
        $newYesVotes = $this->YesVotes + 1;
        $pollID = $this->activePollID;
        $query = "UPDATE polls SET yes='$newYesVotes' WHERE id='$pollID'";
        $result = $mysqli_cms->query($query);
        $query2 = "INSERT INTO poll_votes (ip) VALUES ('$ip')";
        $result2 = $mysqli_cms->query($query2);
        if ($result && $result2) {
            return true;
        } else {
            return false;
        }
    }

    public function voteNo() {
        global $mysqli_cms;

        $ip = $_SERVER['REMOTE_ADDR'];
        $newNoVotes = $this->NoVotes + 1;
        $pollID = $this->activePollID;
        $query = "UPDATE polls SET no='$newNoVotes' WHERE id='$pollID'";
        $result = $mysqli_cms->query($query);
        $query2 = "INSERT INTO poll_votes (ip) VALUES ('$ip')";
        $result2 = $mysqli_cms->query($query2);
        if ($result && $result2) {
            return true;
        } else {
            return false;
        }
    }

    public function displayAnswers() {
        global $mysqli_cms;

        $query = "SELECT * FROM polls ORDER BY id DESC LIMIT 1";
        $result = $mysqli_cms->query($query);
        $fetch = $result->fetch_assoc();

        return '<span>Yes:</span> ' . $fetch['yes'] . ' ' . '<span>No:</span> ' . $fetch['no'];
    }

}