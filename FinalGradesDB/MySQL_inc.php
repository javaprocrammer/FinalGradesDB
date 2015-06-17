<!DOCTYPE html>
<!--
Created By: Lou Cram
Created On: 5/10/15
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            //echo "<p>inside mysql_inc</p>";
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');
            $dbc=mysqli_connect("localhost", "root", "sesame");
            if(!$dbc) {
                echo '<p>Unable to connect to MySQL</p>';
            } elseif (!mysqli_select_db($dbc, "grades")) {
                echo '<p>Unable to open Grades database</p>';            
            } else {
                //echo '<P>Attached to Grades!</P>';
            }
        ?>
    </body>
</html>
