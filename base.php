<?php
$base64 = base64_encode(file_get_contents('./img/logo.png'));
?>
<img src="data:image/png;base64,<?= $base64 ?>"/>
