<?php

class Polls {

    public $activePollID;
    public $YesVotes;
    public $NoVotes;
    public $Question;

    public function __construct() {
        global $mysqli_cms;

        $query = "SELECT * FROM polls ORDER BY id DESC LIMIT 1";
        $result = $mysqli_cms->query($query);
        $fetch = $result->fetch_assoc();
        $this->activePollID = $fetch['id'];
        $this->YesVotes = $fetch['yes'];
        $this->NoVotes = $fetch['no'];
        $this->Question = $fetch['question'];
    }

    public function displayPopup() {
        global $mysqli_cms;


    }

    public function displayPollID() {
        return $this->activePollID;
    }

    public function saveNewPoll($poll) {
        global $mysqli_cms;

        $result = $mysqli_cms->query("INSERT INTO `polls` (`id`, `question`, `yes`, `no`, `active`, `ip`) VALUES (NULL, '', NULL, NULL, '1', ''), (NULL, '$poll', NULL, NULL, '1', '')");
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function displayActivePoll() {
        return $this->Question;
    }

    public function checkIfHasVoted($poll_id) {
        global $mysqli_cms;
        $ip = $_SERVER['REMOTE_ADDR'];

        $query = "SELECT * FROM poll_votes WHERE ip = '$ip' AND poll_id = '$poll_id'";
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
        $query2 = "INSERT INTO poll_votes (poll_id, ip) VALUES ('$pollID', '$ip')";
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
        $query = "UPDATE poll_votes SET no='$newNoVotes' WHERE id='$pollID'";
        $result = $mysqli_cms->query($query);
        $query2 = "INSERT INTO poll_votes (poll_id, ip) VALUES ('$pollID', '$ip')";
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