<div class="edit_events">

    <h1><i class="fa fa-calendar" aria-hidden="true"></i> Edit events</h1>
    <span class="small">Activate effects that spices up the website around the holidays and other events.</span>
    <button onclick="window.location='admin.php';" class="btn-sm">Go back</button>
    <form method="post">
    <div class="buttons">
        <?php
        $events = new Events();
        $eArray = $events->getEventsArray();

        if (isset($_POST['submit'])) {
            foreach ($eArray as $event) {
                echo $event;
            }
        }

        foreach ($eArray as $item) {
            ?>
            <div class="event-switch">
                <label><?= $events->getEventIdAsName($item['id']); ?></label>
                <label class="switch">
                    <input type="checkbox" name="event<?php echo $item['id']; ?>" <?php if ($item['activated'] > 0) { echo 'checked'; } ?>>
                    <span class="slider round"></span>
                </label>
            </div>
            <?php
        }

        ?>
    </div>
    <br>
    <input type="submit" name="submit" value="Save">
    </form>
<?php

?>

</div>
