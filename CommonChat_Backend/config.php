<?php 
    $LIMIT_CHAT_SIZE = 100; //Максимальное число сообщений в чате
    $MAX_TIME_REQUEST_GETMESSAGE = 20; //Максимальное время, которое сервер будет ждать нового сообщения (в секундах)
    $TIME_AGAIN_CHECK = 1; //с какой скросотью будет выполняться провека в getMessages (В секундах)
    $MESSAGE_CHAT_NAME = "messages.json"; //Имя файла с сообщениями

    $ERROR_MESSAGE_EMPTY = "message empty"; //Ошибка если _GET['message'] пустой
    $ERROR_USER_NAME_EMPTY = "name empty"; //Ошибка если _GET['user_name'] пустой
    $ERROR_MESSAGE_OR_NAME_EMPTY = "not ne message" //Ошибка если нет новых сообщений за установленное время

?>