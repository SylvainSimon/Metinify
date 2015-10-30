<?php @session_write_close(); ?>
<?php @session_start(); ?>
<?php

if (empty($_SESSION['ID'])) {
    echo '0';
} else {
    echo '1';
}
?>