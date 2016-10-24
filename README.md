# Youtube-Vimeo-Video-Mp3-Converter
This is a simple toolkit to convert youtube and vimeo video to mp3 using ffmpeg extension.

Below is the given sample code to convert video to mp3 format.
```php
<?php
include_once("LinkHandler.php");
include_once("YouTubeDownloader.php");
include_once("VimeoDownloader.php");
include_once("Mp3Converter.php");

$url = "https://www.youtube.com/watch?v=nhN3bdbbCxg";
$handler = new LinkHandler();
$downloader = $handler->getDownloader($url);
$downloader->setUrl($url);

Mp3Converter::convertToMp3($downloader, "mp3");
```
