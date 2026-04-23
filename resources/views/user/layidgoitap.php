<?php
session_start();
if (isset($_POST['option'])) {
    $_SESSION['id'] = $_POST['option'];
    echo var_dump($_SESSION['id']);
} else {
    $_SESSION['id'] = 3;
}
?>