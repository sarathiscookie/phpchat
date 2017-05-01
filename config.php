<?php
session_start();
$mysqli = new mysqli("192.168.10.10", "homestead", "secret", "phpchat");
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
$mysqli->set_charset("utf8");

function showChatBox($user_id, $path = null)
{
    global $mysqli;
    if(is_null($path))
    {
        $chat = include 'chatBox.php';
    }
    else{
        $chat = include $path. 'chatBox.php';
    }
    return $chat;
}

function auth()
{
    global $mysqli;
    if(isset($_SESSION['name']))
    {
        $sql = $mysqli->query("SELECT * FROM `users` WHERE `name` = '".$_SESSION['name']."'");
        $user = $sql->fetch_object();
        return $user;
    }
    else{
        return [];
    }
}

function user($id)
{
    global $mysqli;
    $sql = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$id."'");
    $user = $sql->fetch_object();
    return $user;
}

function activeChats()
{
    return isset($_SESSION['chats']) ? $_SESSION['chats'] : [];
}

function addChat($id)
{
    $chats = isset($_SESSION['chats']) ? $_SESSION['chats'] : [];
    if(!in_array($id, $chats))
    {
        $chats[$id] = $id;
        $_SESSION['chats'] = $chats;
        return true;
    }
    else{
        return false;
    }
}

function removeChat($id)
{
    $chats = isset($_SESSION['chats']) ? $_SESSION['chats'] : [];
    if(in_array($id, $chats))
    {
        unset($chats[$id]);
    }
    $_SESSION['chats'] = $chats;
}