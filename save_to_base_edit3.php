<?php
session_start();
?>
<?php

$wiersz3 = $_POST['wiersz3'];

echo "<form action=\"save_to_base_editForm.php\" method=\"POST\" name=\"przekierowanie\">
    <input type=\"hidden\" name=\"cos\" value=\"$wiersz3\">
    </form>
    <script type='text/javascript'>document.przekierowanie.submit();</script>"


?>