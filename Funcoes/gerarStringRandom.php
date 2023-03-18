<?php

$a = 0;
$b = 8;
$Strings='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
echo substr(str_shuffle($Strings), $a, $b);
?>