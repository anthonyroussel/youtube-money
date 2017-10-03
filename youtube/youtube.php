<?php
require_once("youtube/channel.php");

// Return specified http error code with a json status message in response body.
//
function json_return($code, $message) {
  http_response_code($code);
  return json_encode(array("code" => $code, "message" => $message));
}

class Youtube {

  // Youtube Api Key
  private $youtube_api_key;

  // Url of the Youtube Data Api
  private $youtube_api_url = "https://www.googleapis.com/youtube/v3";

  function __construct($youtube_api_key) {
    $this->youtube_api_key = $youtube_api_key;
  }

  /**
   * Search for a channel through the Youtube API.
   * @param q the search string
   * @return the channel object, or null if no result.
   */
  function searchForChannel($q) {
    $url = $this->youtube_api_url . "/search?part=snippet&type=channel&key=" . $this->youtube_api_key . "&q=" . urlencode($q);
    $content = file_get_contents($url);
    $json = json_decode($content);

    // Return null if no results.
    if ($json->pageInfo->totalResults == 0) {
      return null;
    }

    // Parse the channel informations in an internal channel object.
    $channel = new YoutubeChannel();
    $selectedChannel = $json->items[0];
    $channel->id = $selectedChannel->id->channelId;
    $channel->title = $selectedChannel->snippet->title;
    $channel->thumbnail = $selectedChannel->snippet->thumbnails->default->url;
    $channel->statistics = $this->getChannel($channel->id);
    $channel->publishedAt = $selectedChannel->snippet->publishedAt;
    $channel->computeStatistics();

    return $channel;
  }

  /**
   * Get channel statistics through the Youtube API.
   * @param channelId Internal ID of the Youtube channel
   * @return the channel's YoutubeStatistics object
   */
  function getChannel($channelId) {
    $url = $this->youtube_api_url . "/channels?part=statistics&key=" . $this->youtube_api_key . "&id=" . $channelId;
    $content = file_get_contents($url);
    $json = json_decode($content);

    // Parse the channel statistics in an internel statistics object.
    $statistics = new YoutubeChannelStatistics();
    $selectedStatistics = $json->items[0]->statistics;
    $statistics->viewCount = $selectedStatistics->viewCount;
    $statistics->subscriberCount = $selectedStatistics->subscriberCount;
    $statistics->videoCount = $selectedStatistics->videoCount;

    return $statistics;
  }
}
?>