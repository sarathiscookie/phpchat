<?php
include 'config.php';
if(!isset($_SESSION['name']))
{
    header('location:login.php');
    die();
}
//unset($_SESSION['chats']);
?>
<!DOCTYPE html>
<html lang="en" auth="<?php echo auth()->id; ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>PHP Chat</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="/css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2 sidebar">
            <?php
            $query = $mysqli->query("SELECT * FROM `users` WHERE `name` != '".$_SESSION['name']."'");
            ?>
            <ul>
                <?php
                while($row = $query->fetch_array())
                {
                 ?><li>
                    <a href="javascript:;" class="sidebar-user" user-id="<?php echo $row['id']; ?>"><?php echo $row['name']; ?> </a>
                </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="col-md-10">
            <div class="row chat-container">
                <?php
                foreach (activeChats() as $id)
                {
                    echo showChatBox($id);
                }
                ?>
            </div>
        </div>
    </div>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://js.pusher.com/4.0/pusher.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script src="/js/script.js"></script>
<script src="/js/my_pusher.js"></script>
</body>
</html>