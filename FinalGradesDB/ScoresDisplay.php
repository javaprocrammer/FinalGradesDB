<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Display of Scores</title>
    </head>
    <body>
        <h1>Students on File</h1>        
        <?php
            require_once ('MySQL_inc.php');
            echo "<table border=1><caption>Students on File</caption>";
            echo "<tr><th>ID</th><th>Last Name</th><th>First Name</th><th>Quiz Average</th>"
            . "<th>Course Average</th><th>Grade</th></tr>";
            $query = 'SELECT student_id, last_name, first_name, quizavg,
                        courseavg, grade';
            $query .= ' FROM students';
            $query .= ' ORDER BY student_id';
            $result = mysqli_query($dbc, $query);
            while ($row = mysqli_fetch_array($result)) {
                $avg1 = number_format($row['quizavg']);
                $avg2 = number_format($row['courseavg']);
                echo '<tr>';
                    echo "<td>{$row['student_id']}</td>"; 
                    echo "<td>{$row['last_name']}</td>";
                    echo "<td>{$row['first_name']}</td>";
                    echo "<td>$avg1</td>";
                    echo "<td>$avg2</td>";
                    echo "<td>{$row['grade']}</td>";
                echo '</tr>';
            }
            echo "</table>";
        ?>         
    </body>
</html>
