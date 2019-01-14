<h1>Veckans Väder</h1>
<div class="weather-display">

<?php
foreach ($wd['daily']['data'] as $day => $data) {
    echo "<div class='daybox'>";
    echo '<span style="font-size:2rem;">' . $data['summary'] . '</span>';
    echo "<br>";
    echo '<span style="font-size:1.6rem;">Temperatur: ' . $data['temperatureLow'] . '&deg;C - ' . $data['temperatureHigh'] . '&deg;C</span>';
    echo "<br>";
    echo '<span style="font-size:1.6rem;">Vind: ' . $data['windSpeed'] . ' bearing ' . $data['windBearing'] . '</span>';
    echo "<br><br>";
    echo "</div>";
}
?>
</div>
