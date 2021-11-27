<?php 
    function sendMessage($msg, $user_name)
    {
        include("config.php");
        include("utils/message.php");

        $textFileMessage = file_get_contents($MESSAGE_CHAT_NAME);
        if($textFileMessage != "" && $textFileMessage != null){
            $messages = json_decode($textFileMessage);

            $message = new Message();
            $message->message =$msg;
            $message->user_name = $user_name;
      
            $messages->messages[count($messages->messages)] = $message;

            if(count($messages->messages) >= $LIMIT_CHAT_SIZE){
                array_shift($messages->messages);
            }

            file_put_contents($MESSAGE_CHAT_NAME, json_encode($messages));
        }
        else{
            $message = new Message();
            $message->message =$msg;
            $message->user_name = $user_name;

            $messages = array(
                $message
            );
            $m2 = ["messages"=>$messages];
            file_put_contents($MESSAGE_CHAT_NAME, json_encode($m2));
        }
   
    }
?>