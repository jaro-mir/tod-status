<!doctype html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/main.css" />
</head>
<body>
    <img src="images/background.jpg" />
    <div id="horde_nb"><?php echo $horde_nb ?></div>
    <div id="ally_nb"><?php echo $ally_nb ?></div>
    <div id="status">
    <?php if($is_online): ?>
    <span class="status_online">
        online
    </span>
    <?php else: ?>
    <span class="status_offline">
        offline
    </span>
    <?php endif ?>
    </div>
    <div id="uptime"><?php echo $uptime ?></div>

</body>
</html>
