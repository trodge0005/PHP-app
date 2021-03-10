<?php
for($i = 0; $i < 9999; $i++) {
    $conn = mysql_connect(...);
    $db = mysql_select_db(...);
    $res = mysql_query(...);
    $data = mysql_fetch_assoc($res);
    mysql_close();
}
?>