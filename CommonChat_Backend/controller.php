<?php
    include("getMessages.php");
    include("createMessage.php");
    include("config.php");
    
    $type = $_GET['type'];

    switch($type){
        case "getMessages":
            if(isset($_POST['last_messages'])){
                getMessages($_POST['last_messages']);
            }
            else{
                getMessages(null);
            }
            break;
        case "sendMsg":
            if(isset($_GET['message']) && isset($_GET['user_name'])){
                sendMessage($_GET['message'], $_GET['user_name']);
            }
            else{
                echo $ERROR_MESSAGE_OR_NAME_EMPTY;
            }
            break;
    }
?>