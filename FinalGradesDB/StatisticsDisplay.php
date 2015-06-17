<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Class Statistics</title>
    </head>
    <body>
        <h1>Grade Statistics for Current Class</h1>
        <?php
        $stu_count = 0;
        $clsAvg = 0;
        $Anum = 0;
        $Bnum = 0;
        $Cnum = 0;
        $Dnum = 0;
        $Fnum = 0;
        require_once ('MySQL_inc.php');
        $q = "SELECT COUNT(*), AVG (courseavg) AS courseavg_avg,"
                . " SUM(CASE WHEN grade = 'A' THEN 1 ELSE 0 END) as anum, "
                . " SUM(CASE WHEN grade = 'B' THEN 1 ELSE 0 END) as bnum, "
                . " SUM(CASE WHEN grade = 'C' THEN 1 ELSE 0 END) as cnum, "
                . " SUM(CASE WHEN grade = 'D' THEN 1 ELSE 0 END) as dnum, "
                . " SUM(CASE WHEN grade = 'F' THEN 1 ELSE 0 END) as fnum ";
        $q .= " FROM students;";
        $r = mysqli_query($dbc, $q);
        if (!$r) {
            printf("Error: %s\n", mysqli_error($dbc));
            exit();
        }       
        while ($row = mysqli_fetch_array($r)) {
            //$row = mysqli_fetch_array($r);
            $stu_count = $row['COUNT(*)'];
            $holder = $row['courseavg_avg'];
            $clsAvg = number_format($holder);
            $Anum = $row['anum'];
            $Bnum = $row['bnum'];
            $Cnum = $row['cnum'];
            $Dnum = $row['dnum'];
            $Fnum = $row['fnum'];
        }        
        echo "<table border=1><caption>Class Statistics</caption>";
        echo "<tr><th># of Students</th><th>Class Average</th><th>#of A's</th><th># of B's</th>"
        . "<th># of C's</th><th># of D's</th><th># of F's</th></tr>";
        echo '<tr>';
            echo "<td>$stu_count</td>";
            echo "<td>$clsAvg</td>";
            echo "<td>$Anum</td>";
            echo "<td>$Bnum</td>";
            echo "<td>$Cnum</td>";
            echo "<td>$Dnum</td>";
            echo "<td>$Fnum</td>";
        echo '<tr>';
        ?>
    </body>
</html>
