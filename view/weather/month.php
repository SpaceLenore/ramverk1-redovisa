<h1>Vädret för de 30 senaste dagarna</h1>
<div class="weather-display">

<?php
    // var_dump($wd[0]['daily']['data'][0]);
for ($i=0; $i < sizeof($wd) - 1; $i++) {
    echo "<div class='daybox'>";
    echo '<span style="font-size:2rem;">' . $wd[$i]['daily']['data'][0]['summary'] . '</span>';
    echo "<br>";
    echo '<span style="font-size:1.6rem;">Temperatur: ' . $wd[$i]['daily']['data'][0]['temperatureLow'] . '&deg;C - ' . $wd[$i]['daily']['data'][0]['temperatureHigh'] . '&deg;C</span>';
    echo "<br>";
    echo '<span style="font-size:1.6rem;">Vind: ' . $wd[$i]['daily']['data'][0]['windSpeed'] . ' bearing ' . $wd[$i]['daily']['data'][0]['windBearing'] . '</span>';
    echo "<br><br>";
    echo "</div>";
}
?>
</div>
