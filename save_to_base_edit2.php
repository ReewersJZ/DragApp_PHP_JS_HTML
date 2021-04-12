<?php
session_start();
?>
<?php

$wiersz2 = $_POST['wiersz2'];

echo "<form action=\"save_to_base_editForm.php\" method=\"POST\" name=\"przekierowanie\">
    <input type=\"hidden\" name=\"cos\" value=\"$wiersz2\">
    </form>
    <script type='text/javascript'>document.przekierowanie.submit();</script>"


?>