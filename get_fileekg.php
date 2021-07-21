<?php

$file = $_POST['file'];
$content = file_get_contents('ftp://username:password@192.168.xx.xx/ekg/updated/'.$file, true);
file_put_contents('ekgoutput/output.pdf', $content);
echo '<embed src="ekgoutput/output.pdf#zoom=94&toolbar=0" type="application/pdf" width="100%" height="550px" />';

?>