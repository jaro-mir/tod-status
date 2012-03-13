<!doctype html>
<html>
<head>
<link type="text/css" rel="stylesheet" href="css/storm_h.css" />
<script type="text/javascript" src="js/storm.js"></script>
</head>
<body>
    <div class="storm" onclick="refreshStatus('widget.php?layout=storm_h')">
        <div id="indicator" style="display: none"><img src="images/indicator.gif" /></div>
        <img src="images/storm_h.png" />
        <div id="horde_nb"><?php echo $horde_nb ?></div>
        <div id="ally_nb"><?php echo $ally_nb ?></div>
        <div id="status">
        <?php if($is_online === true): ?>
        <span class="status_online">
            online
        </span>
        <?php elseif($is_online === false): ?>
        <span class="status_offline">
            offline
        </span>
        <?php else: ?>
        <span class="status_error">
            błąd
        </span>
        <?php endif ?>
        </div>
        <div id="uptime"><?php echo $uptime ?></div>
    </div>
</body>
</html>
