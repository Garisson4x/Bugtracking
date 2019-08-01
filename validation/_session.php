<?php
session_start();
if (!isset($_SESSION["user"])) {
    header('Location: /index.html');
}
function is_allowed($creator_id) {
    if ($_SESSION["user_obj"]->role == 'admin' || $_SESSION["user_obj"]->id == $creator_id){
        return true;
    }
}
?>
