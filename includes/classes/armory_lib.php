<?php

class Armory {

    public $searchString;
    public $charName;

    public function __construct() {
    }

    public function AllCharsNum() {
        global $mysqli;

        $returnAll = $mysqli->query("SELECT * FROM characters");
        return $returnAll->num_rows;
    }

    public function getCharacterFromName($characterName) {
        global $mysqli;

        $result = $mysqli->query("SELECT * FROM characters WHERE name = '$characterName'");
        $row = $result->fetch_assoc();
        return $row['name'] . ', Level: ' . $row['level'];
    }

    public function getAllCharacters() {
        global $mysqli;

        $result = $mysqli->query("SELECT * FROM characters ORDER BY name");
        $result->fetch_array();
        return $result;
    }

    public function getCharacterFromString($searchString) {
        global $mysqli;

        $this->searchString = $searchString;
        $result = $mysqli->query("SELECT * FROM characters WHERE name COLLATE UTF8_GENERAL_CI LIKE '%$searchString%'");
        $num = $result->num_rows;
        if ($num > 0) {
            while ($row = $result->fetch_assoc()) {
                return '<a href="?charname=' . strtolower($row['name']) . '">' . $row['name'] . '</a>';
            }
        } else {
            return '<p>No characters found...</p>';
        }

    }

    public function displayCharacter($charName) {
        global $mysqli;

        $result = $mysqli->query("SELECT * FROM characters WHERE name COLLATE UTF8_GENERAL_CI = '$charName'");
        $row = $result->fetch_assoc();
        return $row;
    }

}

?>