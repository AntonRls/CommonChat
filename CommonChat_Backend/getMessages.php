<?php 
    function getMessages($lastMessageJson){
        include("config.php");
        
        $active = true;
        $timeRequsting = 0;
        while($active){
            if($lastMessageJson == file_get_contents($MESSAGE_CHAT_NAME)){
                sleep($TIME_AGAIN_CHECK);
                $timeRequsting++;
                if($timeRequsting >= $MAX_TIME_REQUEST_GETMESSAGE){
                    echo $lastMessageJson;
                    $active = false;
                }
            }
            else{
                echo(file_get_contents($MESSAGE_CHAT_NAME));
                $active = false;
            }
        }

    }
?>