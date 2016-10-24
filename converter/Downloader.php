<?php
abstract class Downloader {
    
    /*
     * Video Id for the given url
     */
    protected $video_id;
    
    /*
     * Video title for the given video
     */
    
    protected $video_title;
    
    /*
     * Full URL of the video
     */
    
    protected $video_url;
    
    public function __construct() {
     
    }
     
    /*
     * Set the url
     * @param string
     */
    public function setUrl($url)
    {
        $this->video_url = $url;
    }
    
    /*
     * Get the title
     */
    public function getTitle()
    {
        return $this->video_title;
    }
    
    /*
     * Get the downloadlink for video
     * return array
     */
    
    public abstract function getVideoDownloadLink();
    
    public static function downloadVideo($video_file_url, $extension, $title)
    {
        $header_info = get_headers($video_file_url, 1);
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="'.$title.'.'.$extension.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . $header_info["Content-Length"]);
        readfile($video_file_url);
    }
}

