<?php
include '../config.php';
require('../php/Pusher.php');

if(isset($_POST))
{
    $pusher = new Pusher(
        '8f8c6ecc50a7bfb9c674',
        '3791a46fb5a904c1fe76',
        '311836'
    );

    $from              = auth()->id;
    $to                = $_POST['to'];
    $name_to           = user($_POST['to'])->name;
    $name_from         = user($from)->name;
    $message           = $_POST['message'];
    $alert             = $from == auth()->id ? 'alert-info' : 'alert-success';

    $data['message'] = $message;
    $data['to']      = $to;
    $data['from']    = $from;
    $data['alert']   = $alert;
    $data['name_from'] = $name_from;
    $data['name_to']   = $name_to;
    $pusher->trigger('chat', 'my-event', $data);
    /*$pusher->trigger('show_chat_box', 'my-event', $data);*/

    $mysqli->query("INSERT INTO `chat` (`from`, `to`, `message`) VALUES ('".$from."', '".$to."', '".$message."')");
}