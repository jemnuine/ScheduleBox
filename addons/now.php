<?php
echo "Today is " . date('l') . ". " . (string)date("F", mktime(0, 0, 0, date('n'), 10)) . " " . date("d, Y");
?>