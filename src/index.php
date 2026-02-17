<?php

header('Content-Type: application/json');

$city = $_GET['city'] ?? '';

if (!$city) {
    echo json_encode(["error" => "city is required"]);
    exit;
}


$geoUrl = "https://geocoding-api.open-meteo.com/v1/search?name=" . urlencode($city);

$geoResponse = json_decode(file_get_contents($geoUrl), true);

if (!isset($geoResponse['results'][0])) {
    echo json_encode(["error" => "City not found"]);
    exit;
}

$lat = $geoResponse['results'][0]['latitude'];
$lon = $geoResponse['results'][0]['longitude'];
$cityName = $geoResponse['results'][0]['name'];


$weatherUrl = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true";

$weatherResponse = json_decode(file_get_contents($weatherUrl), true);

$current = $weatherResponse['current_weather'];
$weatherCodes = [
    0 => "Clear sky",
    1 => "Mainly clear",
    2 => "Partly cloudy",
    3 => "Overcast",
    45 => "Fog",
    48 => "Depositing rime fog",
    51 => "Light drizzle",
    53 => "Moderate drizzle",
    55 => "Dense drizzle",
    61 => "Slight rain",
    63 => "Moderate rain",
    65 => "Heavy rain",
    71 => "Slight snow",
    73 => "Moderate snow",
    75 => "Heavy snow",
    80 => "Rain showers",
    95 => "Thunderstorm"
];

$condition = $weatherCodes[$current['weathercode']] ?? "Unknown";

$result = [
    "city" => $cityName,
    "temperature" => $current['temperature'],
    "condition_code" => $condition,
    "timestamp" => $current['time']
];

echo json_encode($result);