<?php

class YoutubeChannel {
  public $id;
  public $title;
  public $thumbnail;
  public $publishedAt;
  public $statistics;

  function __construct() { }

  /**
   * Compute the number of months since the channel creation
   * @return integer
   */
  function numberMonthsSinceCreation() {
    $dt = date_create(date('Y-m-d', strtotime($this->publishedAt)));
    $now = date_create(date('Y-m-d'));

    $diff = date_diff($dt, $now);
    $nbMonths = $diff->y * 12 + $diff->m + $diff->d/30 + $diff->h / 24;

    return ceil($nbMonths);
  }

  /**
   * Compute average number of video per month.
   * @param integer numberMonthsSinceCreation
   * @return float
   */
  function computeVideoPerMonth($numberMonthsSinceCreation) {
    return round($this->statistics->videoCount / $numberMonthsSinceCreation, 2);
  }

  /**
   * Compute estimated money won by the youtuber.
   * @param integer numberMonthsSinceCreation
   * @return float
   */
  function computeMoney($numberMonthsSinceCreation) {
    return round($this->statistics->viewCount / 1000, 2);
  }

  /**
   * Compute statistics about average video published per months
   * and about the estimated money won by the youtuber.
   */
  function computeStatistics() {
    $numberMonthsSinceCreation = $this->numberMonthsSinceCreation();
    $this->statistics->videoPerMonth = $this->computeVideoPerMonth($numberMonthsSinceCreation);
    $this->statistics->money = $this->computeMoney($numberMonthsSinceCreation);
  }
}

class YoutubeChannelStatistics {
  public $viewCount;
  public $subscriberCount;
  public $videoCount;
  public $videoPerMonth;
  public $money;

  function __construct() { }
}