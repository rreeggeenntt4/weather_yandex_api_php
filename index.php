<?php
$opts = array(
    'http' => array(
        'method' => "GET",
        'header' => "X-Yandex-API-Key:731f7bc9-fdec-4db7-bc0b-b3b57212d6fb\r\n"
    )
);

$context = stream_context_create($opts);

$f = file_get_contents("https://api.weather.yandex.ru/v2/forecast?lat=68.97066498&lon=33.07491302&extra=true", false, $context);

$f = json_decode($f);
/* echo "<pre>";
print_r($f);
echo "<pre>"; */
$cityobj = $f->geo_object;
echo "Город: " . $cityobj->locality->name . " <br><br>";


$t = $f->fact;
echo "Температура: " . $t->temp . "°C (ощущается как " . $t->feels_like . "°C)<br>"
    . "Скорость ветра: " . $t->wind_speed . " м/с.<br>"
    . "Скорость порывов ветра:" . $t->wind_gust . " м/с<br>"
    . "Направление ветра: " . $t->wind_dir . "<br>"
    . "Давление: " . $t->pressure_mm . " мм рт. ст.(" . $t->pressure_mm . "гПа)<br>"
    . "Влажность воздуха: " . $t->humidity . "%<br>"
    . "Время суток: " . $t->daytime . "<br>"
    . "Время замера погодных данных в формате Unixtime: " . $t->obs_time . "(" . date('Y-m-d h:i:s', $t->obs_time) . ")";
