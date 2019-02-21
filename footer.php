<footer>
    <div class="footer-border"></div>
    <div class="container">
        <div class="footer-content">
            <div class="social-icons">
                <?php
                $socialQuery = $mysqli_cms->query("SELECT * FROM config");
                $socialFetch = $socialQuery->fetch_assoc();
                $facebookURL = $socialFetch['facebook'];
                $instagramURL = $socialFetch['instagram'];
                $twitterURL = $socialFetch['twitter'];
                $youtubeURL = $socialFetch['youtube'];
                $discordURL = $socialFetch['discord'];
                if (strlen($facebookURL) > 0) {
                    ?>
                    <a href="<?= $facebookURL; ?>" target="_blank" title="Visit our Facebook"><div class="facebook-icon grayscale"></div></a>
                    <?php
                }
                if (strlen($instagramURL) > 0) {
                    ?>
                    <a href="<?= $instagramURL; ?>" target="_blank" title="Visit our Instagram"><div class="instagram-icon grayscale"></div></a>
                <?php
                }
                if (strlen($twitterURL) > 0) {
                    ?>
                    <a href="<?= $twitterURL; ?>" target="_blank" title="Visit our Twitter"><div class="twitter-icon grayscale"></div></a>
                <?php
                }
                if (strlen($youtubeURL) > 0) {
                    ?>
                    <a href="<?= $youtubeURL; ?>" target="_blank" title="Visit our YouTube"><div class="youtube-icon grayscale"></div></a>
                <?php
                }
                if (strlen($discordURL) > 0) {
                    ?>
                    <a href="<?= $discordURL; ?>" target="_blank" title="Join our Discord"><div class="discord-icon grayscale"></div></a>
                    <?php
                }
                ?>
            </div>
        </div>
        <div class="footer-copyright"><?php echo $servername; ?> © <?php echo date("Y"); ?><br />Powered by a <a
                    href="https://github.com/MariusTBjercke/BlizzlikeCMS" target="_blank">Blizzlike CMS</a></div>
    </div>
</footer>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="includes/featherlight/featherlight.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="node_modules/timeago/jquery.timeago.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="includes/slick/slick.min.js"></script>
<script src="dist/bundle.js"></script>
<script src="js/site.min.js"></script>
</body>
</html>