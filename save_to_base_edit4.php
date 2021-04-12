<?php
session_start();
?>
<?php

$wiersz4 = $_POST['wiersz4'];

echo "<form action=\"save_to_base_editForm.php\" method=\"POST\" name=\"przekierowanie\">
    <input type=\"hidden\" name=\"cos\" value=\"$wiersz4\">
    </form>
    <script type='text/javascript'>document.przekierowanie.submit();</script>"


?>