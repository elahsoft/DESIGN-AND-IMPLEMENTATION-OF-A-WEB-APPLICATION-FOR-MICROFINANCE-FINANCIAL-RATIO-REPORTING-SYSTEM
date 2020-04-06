<?php
    require_once '../models/Users.php';

    session_start();

    $username = $_POST['username'];
    $password = $_POST['password'];

    $whereDataArray = array(1);
    $whereFieldArray = array('status');
    $logic = "";
    $users = new Users();
    $userRecords = $users->select($whereDataArray, $whereFieldArray, $logic);
    
    $dusername = $userRecords[0]['username'];
    $dpassword = $userRecords[0]['password'];
    $dstatus = $userRecords[0]['status'];

    if ($users->encryptPassword($password) == $dpassword && $username == $dusername) {
        $_SESSION['logged-in'] = true;
        $_SESSION['LAST_ACTIVITY'] = time();
        header("Location: ../admin/index.php");
    }
    else {
        $_SESSION['error'] = "Signin Details Incorrect. Please correct!";
        $_SESSION['logged-in'] = false;
        header("Location: ../index.php");
    }
?>