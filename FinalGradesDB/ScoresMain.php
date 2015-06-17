<!DOCTYPE html>
<!--
Created By: Lou Cram
Created On: 5/10/15
-->
<html>
    <head>
        <meta charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="gradestyle.css">
        <script language="javascript" src="students.js"></script>
        <title>Student Grade Calculator</title>
    </head>
    <body>
        <script type="javascript" src="ajax.js"></script>
        <script type="javascript" src="DataTables.js"></script>
        <?php            
            require_once('MySQL_inc.php'); //pulls in the mysql code
            $msg1 = "";
            $msg2 = "";
            $stu_id = "";
            $last = "";
            $first = "";
            $q1 = "";
            $q2 = "";
            $q3 = "";
            $q4 = "";
            $q5 = "";
            $makeup = "";
            $qavg = "";
            $mid = "";
            $prob = "";
            $final = "";
            $cavg = "";
            $grade = "";
            if(isset($_POST['btnAdd'])) {
                $stu_id = $_POST['StudentNo'];
                $last = $_POST['LastName'];
                $first = $_POST['FirstName'];
                $q1 = $_POST['Q1'];
                $q2 = $_POST['Q2'];
                $q3 = $_POST['Q3'];
                $q4 = $_POST['Q4'];
                $q5 = $_POST['Q5'];
                $makeup = $_POST['Quiz_Make-Up'];
                $qavg = $_POST['QzAvg'];
                $mid = $_POST['MidTerm'];
                $prob = $_POST['Problems'];
                $final = $_POST['Final'];
                $cavg = $_POST['CrsAvg'];
                $grade = $_POST['LtrGrd'];
                if(empty($grade)) { 
                    $msg1 = '<strong>Please fill in all fields and press Calculate, before Add Student.</strong>';
                } else {
                    $q = "INSERT INTO students VALUES ('$stu_id', '$last', '$first',";
                    $q .= "'$q1', '$q2', '$q3', '$q4', '$q5', '$makeup', '$qavg',";
                    $q .= "'$mid', '$prob', $final, '$cavg', '$grade')";
                
                    if(mysqli_query($dbc, $q)) {
                        $msg2 = "Successfully added " .$first. " " .$last. " to list.";
                        $stu_id = "";
                        $last = "";
                        $first = "";
                        $q1 = "";
                        $q2 = "";
                        $q3 = "";
                        $q4 = "";
                        $q5 = "";
                        $makeup = "";
                        $qavg = "";
                        $mid = "";
                        $prob = "";
                        $final = "";
                        $cavg = "";
                        $grade = "";
                    } else {
                        $msg1 = "SQL Failed: $q";
                    }
                }
            }
        ?>
        <h1>Student Score Input</h1>
        <form id="form1" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <table BORDER="0">
               <tr>
                  <td>Student Number:</td>
                  <td>Last Name:</td>
                  <td>First Name:</td>
               </tr>

               <tr>
                   <td><input type="text" id="StudentNo" name="StudentNo" size="20"
                              value="<?php echo $stu_id ?>"></td>
                   <td><input type="text" id="LastName" name="LastName" size="20"
                              value="<?php echo $last ?>"></td>
                   <td><input type="text" id="FirstName" name="FirstName" size="20"
                              value="<?php echo $first ?>"></td>
               </tr>
        </table>
        <br>
        <table border="0">
            <tr>
                <td>Q1:</td>
                <td>Q2:</td>
                <td>Q3:</td>
                <td>Q4:</td>
                <td>Q5:</td>
                <td>Quiz Make-Up:</td>    

            </tr>
            <tr>
                <td><input type="text" id="Q1" name="Q1" size="8"
                          value="<?php echo $q1 ?>"></td>
                <td><input type="text" id="Q2" name="Q2" size="8"
                          value="<?php echo $q2 ?>"></td>
                <td><input type="text" id="Q3" name="Q3" size="8"
                          value="<?php echo $q3 ?>"></td>
                <td><input type="text" id="Q4" name="Q4" size="8"
                          value="<?php echo $q4 ?>"></td>
                <td><input type="text" id="Q5" name="Q5" size="8"
                          value="<?php echo $q5 ?>"></td>
                <td><input type="text" id="Quiz_Make-Up" name="Quiz_Make-Up" size="8"
                          value="<?php echo $makeup ?>"></td>
            </tr>
        </table>
        <br>
        <table border="0">
            <tr>
                <td>Mid-Term:</td>
                <td>Problems:</td>
                <td>Final:</td>
            </tr>
            <tr>
                <td><input type="text" id="MidTerm" name="MidTerm" size="8"
                           value="<?php echo $mid ?>"></td>
                <td><input type="text" id="Problems" name="Problems" size="8"
                           value="<?php echo $prob ?>"></td>
                <td><input type="text" id="Final" name="Final" size="8"
                           value="<?php echo $final ?>"></td>
            </tr>
        </table>
        <p><input type="button" id="btnCalc" name="btnCalc" value="Calculate">
            <input type="submit" id="btnClr" name="btnClr" value="Clear">
        <?php
            if(isset($_POST['btnClr'])) {
                $msg1 = "";
                $msg2 = "";
            }
        ?>        
        <div id="errors"></div>
        <table border="0">
            <tr>
                <td style="padding-right:10px">Quiz Average:</td>
                <td style="padding-right:10px">Course Average:</td>
                <td>Letter Grade:</td>
            </tr>
            <tr>
                <td><input type="text" id="QzAvg" name="QzAvg" size="8" 
                           value="<?php echo $qavg ?>" readonly=""></td>
                <td><input type="text" id="CrsAvg" name="CrsAvg" size="8"
                           value="<?php echo $cavg ?>" readonly=""></td>
                <td><input type="text" id="LtrGrd" name="LtrGrd" size="8"
                           value="<?php echo $grade ?>" readonly=""></td>
            </tr>
        </table><br>
        
        <input name="btnAdd" id="btnAdd" type="submit" value="Add Student">
        <input type="button" id="btnStats" name="btnStats" onclick="location.href='StatisticsDisplay.php'" value="Show Statistics">
        <div id="results"></div>       
        </form><br>
        
        <form id="list" method="get" action="ScoresDisplay.php">
            <input type="submit" id="btnList" name="btnList" value="List Students">            
        </form>
        <br>
        <?php echo "<span> $msg1 </span>"; ?>
        <?php echo "$msg2"; ?>
        <div id="tables"></div>
    </body>
</html>
