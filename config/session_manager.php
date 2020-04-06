<?php
//session_start();

function setLastActivityTime() {
    $_SESSION['LAST_ACTIVITY'] = time();
}
function checkTimeOut() {
    if (time() - $_SESSION['LAST_ACTIVITY'] > 1800) {
        $_SESSION['timed_out'] = true;
    }
    else {
        $_SESSION['timed_out'] = false;
        setLastActivityTime();
    }
}

?>