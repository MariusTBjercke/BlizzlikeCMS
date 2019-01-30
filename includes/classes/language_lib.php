<?php

class Language {

    public $returnInLanguage;
    public $shortLang;

    public function __construct($language) {
        if ($language == 'noNO') {
            $this->returnInLanguage = 'norwegian';
            $this->shortLang = 'noNO';
        } elseif ($language == 'enEN') {
            $this->returnInLanguage = 'english';
            $this->shortLang = 'enEN';
        }
    }

    public function get($langstring, $usetwostrings = false, $secondstring = false) {
        global $sqlConnect;

        if ($usetwostrings == true) {
            $secondQuery = "SELECT * FROM language WHERE langstring='$secondstring'";
            $secondresult = $sqlConnect->query($secondQuery);
            $secondAssoc = $secondresult->fetch_assoc();
        }
        $query = "SELECT * FROM language WHERE langstring='$langstring'";
        $result = $sqlConnect->query($query);
        $assoc = $result->fetch_assoc();
        if ($result->num_rows > 0) {
            if ($this->returnInLanguage == 'norwegian') {
                if ($usetwostrings == true) {
                    return $assoc['no'] . ' ' . strtolower($secondAssoc['no']);
                } else {
                    return $assoc['no'];
                }
            } else {
                if ($usetwostrings == true) {
                    return $assoc['en'] . ' ' . strtolower($secondAssoc['en']);
                } else {
                    return $assoc['en'];
                }
            }
        } else {
            return false;
        }
    }

    public function getLanguage() {
        return $this->shortLang;
    }

    public function languageSelector($addclass = false, $classes = false, $height = '22px') {
        $class = false;
        if ($addclass == true) {
            $class = ' ' . $classes;
        }
        if ($this->shortLang == 'noNO') { echo '<a href="?lang=enEN" title="'.$this->get('changelangto').'"><div class="en_flag'.$class.'" style="background-size: auto '.$height.'"></div></a>'; } else { echo '<a href="?lang=noNO" title="'.$this->get('changelangto').'"><div class="no_flag'.$class.'" style="background-size: auto '.$height.'"></div></a>'; }
    }

}
