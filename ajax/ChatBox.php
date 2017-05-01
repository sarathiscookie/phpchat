<?php
include '../config.php';
if(isset($_GET['id']))
{
    if(addChat($_GET['id']))
    {
        echo showChatBox($_GET['id'], '../');
    }
}

if(isset($_GET['remove']))
{
    removeChat($_GET['remove']);
    foreach(activeChats() as $id)
    {
        echo showChatBox($id,'../');
    }
}