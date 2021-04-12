<?php
session_start();
?>

<?php

$wiersz1 = $_POST['wiersz1'];

echo "<form action=\"save_to_base_editForm.php\" method=\"POST\" name=\"przekierowanie\">
    <input type=\"hidden\" name=\"cos\" value=\"$wiersz1\">
    </form>
    <script type='text/javascript'>document.przekierowanie.submit();</script>"


?>