<?php

class Mp3Converter {
    
    public function __construct() {
        set_time_limit(0);
    }
    
    public static function convertToMp3(Downloader $downloader, $destination_folder = "")
    {
        if($destination_folder != "" && !is_dir($destination_folder))
        {
            throw new Exception("Folder doesnot exists");
        }
        
        //get the whole detail of the video link
        $full_link = $downloader->getVideoDownloadLink();
        
        //get the orginal video url
        $raw_url = $full_link[0]["url"];
        
        //get the video extension
        $vid_extension = $full_link[0]["format"];
        
        //get the video title
        $title = $downloader->getTitle();
        
        //generate the random token
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);
        
        //append the token with video title
        $full_title = $title."_{$token}";
        
        //read a data from raw url and write a separate video file
        
        $contents = "";
        $file_reader = fopen($raw_url, "rb");
        $file_writer = fopen($token.".".$vid_extension, "wb");
        
        while(!feof($file_reader))
        {
            $contents .= fread($file_reader, 4096);
        }
        fwrite($file_writer, $contents);
        fclose($file_reader);
        fclose($file_writer);
        
        //add meta data to mp3 
        $meta_data = "-metadata comment=\"www.sauryatech.com\"";
        
        //command to convert to mp3
        $cmd = "./ffmpeg -i {$token}.{$vid_extension} {$meta_data} -b:a 320k {$token}.mp3";
        
        //execute the command
        exec($cmd);
        
        //delete the video file
        unlink($token.".".$vid_extension);
        
        //save the generated mp3 file to the destination folder.
        rename($token.".mp3", $destination_folder."/".$full_title.".mp3");
    }
}

