<?php
$armory = new Armory();

if (isset($_POST['charsearch'])) {
    $charname = addslashes(trim($_POST['charname']));
    $searchResult = $armory->getCharacterFromString($charname);
}

?>
<div class="characters-page">

    <h2>Characters</h2>

    <p>Get basic information about a character on the server.</p>

    <form action="" method="post">
        <h3>Search for a character: <input type="text" name="charname"><input type="submit" name="charsearch" value="Search"></h3>
    </form>

    <div class="character-info">
        <?php
        print_r($searchResult);
        ?>
    </div>

    <div class="display-character">
        <?php
        if ($_GET['charname']) {
            $charname = $_GET['charname'];
            $row = $armory->displayCharacter($charname);

            $character = new Player($charname);
            $character->setClass($row['class']);
            $character->setRace($row['race']);
            $character->setStatus($row['online']);
            $character->setFaction($character->race);

            ?>

            <p><label>Name:</label> <?php echo $row['name']; ?></p>
            <p><label>Race:</label> <?php echo $character->getRace(); ?></p>
            <p><label>Level:</label> <?php echo $character->getLevel(); ?></p>
            <p><label>Faction:</label> <?php echo ucfirst($character->getFaction()); ?></p>
            <p><label>Status:</label> <?php echo $character->getStatus(); ?></p>

            <?php
        }
        ?>
    </div>

</div>
