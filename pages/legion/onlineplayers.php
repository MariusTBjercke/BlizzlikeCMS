<div class="onlineplayers">
    <h2>Who's online? (<?php echo $result->num_rows; ?>)</h2>
    <ul class="list-group">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_array()) {

                $player = new Player($row['name']);
                $player->setClass($row['class']);
                $player->setRace($row['race']);
                $player->setFaction($player->race);

                echo '<<li class="list-group-item ' . $player->getFaction() . '"><div class="' . $player->getFaction() . '_banner"></div><span class="charname">' . $player->getName() . '</span><span class="charinfo">: Level ' . $player->getLevel() . ' ' . $player->getRace() . ', ' . $player->getClass() . '</span></li>';

            }
        } else {
            echo '</ul><p>There are currently no players online.</p>';
        }
        ?>
    </ul>
</div>
