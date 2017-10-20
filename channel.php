<?php
require_once("youtube/youtube.php");
header("Content-type: application/json");

// please put below your youtube data api key
// see https://console.developers.google.com/apis/credentials
//
$youtube_api_key = "INSERT_API_KEY_HERE";

// check for the channel name in the request body
//
if (!isset($_GET['name'])) {
  exit(json_return(400, "Missing parameter: name"));
}
$name = $_GET['name'];

// ask the youtube api for informations about the channel
//
$youtube = new Youtube($youtube_api_key);
$channel = $youtube->searchForChannel($name);

if (!isset($channel)) {
  exit(json_return(404, "Channel not found"));
}

print_r(json_encode($channel));

?>
