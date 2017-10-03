Youtuber Facts
==============

This simple application will give you unknown and surprising facts about your favorite youtubers.
All you wanted to know about them is here!

Authors: Maxime Pinon, Anthony Roussel and Thomas Erl

Website: https://youtuber-facts-anthonyroussel.c9users.io

API Usage
---------

The API has a single endpoint that fetch informations and statistics about a specified channel.

```bash
# search for a channel called cyprien
curl -s http://localhost:8080/channel.php?name=cyprien | jq '.'
{
  "id": "UCyWqModMQlbIo8274Wh_ZsQ",
  "title": "Cyprien",
  "thumbnail": "https://yt3.ggpht.com/-iyVgJA85AAk/AAAAAAAAAAI/AAAAAAAAAAA/xPqZULToWm0/s88-c-k-no-mo-rj-c0xffffff/photo.jpg",
  "publishedAt": "2007-02-25T22:14:05.000Z",
  "statistics": {
    "money": 1676936.88,
    "subscriberPerMonth": 88679.25,
    "viewPerMonth": 13101069.35,
    "videoPerMonth": 0.91,
    "videoCount": "117",
    "subscriberCount": "11350944",
    "viewCount": "1676936877"
  }
}
```

Frontend
--------

The frontend is just a simple html page.

AJAX calls are sent to the backend api to fetch the youtuber statistics and show them asynchronously and dynamically on the page.

Documentation
-------------

API documentation is available through the Swagger website:
https://app.swaggerhub.com/apis/mpinon/youtuberfact/1.0.0

It was generated with the following Yaml file: [docs/api.yaml](docs/api.yaml).
