<?php

class Player {
    public $name;
    public $level;
    public $class;
    public $classID;
    public $race;
    public $faction;
    public $status;
    public $logout_time;

    public function __construct($player_name) {
        $this->name = ucfirst($player_name);
    }

    function getName() {
        return $this->name;
    }

    function getCharQuery($option) {
        global $mysqli;
        $query = "SELECT * FROM characters WHERE name = '$this->name'";
        $result = $mysqli->query($query);
        $row = $result->fetch_assoc();
        $this->$option = $row[$option];
        return $this->$option;
    }

    function getLevel() {
        return $this->getCharQuery('level');
    }

    function getLastOnline() {
        $logoutStamp = $this->getCharQuery('logout_time');
        $logoutDate1 = date('Y-m-d', $logoutStamp);
        $logoutDate2 = date('H:i:s', $logoutStamp);
        $logoutDate = $logoutDate1 . 'T' . $logoutDate2 . 'Z';
        $this->logout_time = $logoutDate;
        return '<time class="timeago" datetime="'.$logoutDate.'"></time>';
    }

    function setStatus($status) {
        $this->status = $status;
    }

    function getStatus() {
        if ($this->status == 1) {
            return '<span class="server-online">Online</span>';
        } else {
            return '<span class="server-offline">Offline</span>';
        }
    }

    function setClass($classID) {
        $this->class = $classID;
    }

    // Get class name from ID
    function getClass()
    {
        switch ($this->class) {
            case 1:
                return 'Warrior';
                break;
            case 2:
                return 'Paladin';
                break;
            case 3:
                return 'Hunter';
                break;
            case 4:
                return 'Rogue';
                break;
            case 5:
                return 'Priest';
                break;
            case 6:
                return 'Deathknight';
                break;
            case 7:
                return 'Shaman';
                break;
            case 8:
                return 'Mage';
                break;
            case 9:
                return 'Warlock';
                break;
            case 11:
                return 'Druid';
                break;
        }
    }

    function setRace($raceID) {
        $this->race = $raceID;
    }

    // Get race from ID
    function getRace() {
        switch ($this->race) {
            case 1:
                return 'Human';
                break;
            case 2:
                return 'Orc';
                break;
            case 3:
                return 'Dwarf';
                break;
            case 4:
                return 'Night Elf';
                break;
            case 5:
                return 'Undead';
                break;
            case 6:
                return 'Tauren';
                break;
            case 7:
                return 'Gnome';
                break;
            case 8:
                return 'Troll';
                break;
            case 10:
                return 'Blood Elf';
                break;
            case 11:
                return 'Draenei';
                break;
        }
    }

    function setFaction($factionID) {
        $this->faction = $factionID;
    }

    // Get faction from race
    function getFaction() {
        switch ($this->faction) {
            case 1:
                return 'alliance';
                break;
            case 2:
                return 'horde';
                break;
            case 3:
                return 'alliance';
                break;
            case 4:
                return 'alliance';
                break;
            case 5:
                return 'horde';
                break;
            case 6:
                return 'horde';
                break;
            case 7:
                return 'alliance';
                break;
            case 8:
                return 'horde';
                break;
            case 10:
                return 'horde';
                break;
            case 11:
                return 'alliance';
                break;
        }
    }

}