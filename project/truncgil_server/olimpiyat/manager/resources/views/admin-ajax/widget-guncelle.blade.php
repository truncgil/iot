<?php echo file_get_contents("http://app.olimpiyat.com.tr/client.php?".urlencode("imei={$_GET['imei']}&command={$_GET['command']}"));

?>