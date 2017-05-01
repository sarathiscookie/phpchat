<div class="col-md-4 chat-box" user-id="<?php echo $user_id; ?>">
    <div class="panel panel-primary">
        <?php
        $query     = $mysqli->query("SELECT * FROM `chat` WHERE `from` IN ('".$user_id."', '".auth()->id."') AND `to` IN ('".$user_id."', '".auth()->id."') ");

        $userQuery = $mysqli->query("SELECT * FROM `users` WHERE `id` = '".$user_id."' ");
        $user      = $userQuery->fetch_array();
        ?>
        <div class="panel-heading">
            <?php echo $user['name']; ?>
            <span class="glyphicon glyphicon-remove pull-right close-chat" aria-hidden="true"></span>
        </div>
        <div class="panel-body chat-user-<?php echo $user_id; ?>">
            <?php
            while($row = $query->fetch_array())
            {
                $alert = $row['from'] == auth()->id ? 'alert-info' : 'alert-success';
            ?>
                <div class="alert <?php echo $alert; ?>"><?php echo user($row['from'])->name.': '. $row['message']; ?></div>
            <?php
            }
            ?>

        </div>
        <div class="panel-footer">
            <input type="text" name="message" class="form-control send-message" placeholder="write message">
        </div>
    </div>
</div>