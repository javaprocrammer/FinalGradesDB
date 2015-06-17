/*
 * Created By: Lou Cram
 * Date Started: 2/14/15
 * Date Last Updated: 2/18/15
 * 
 */

var $ = function(id) {
    return document.getElementById(id);
};
            
window.onload = function() {
    $("btnCalc").onclick = calculate;
    $("btnClr").onclick = clear;
    $("StudentNo").focus();
};

function clear() {
    $("form1").reset();
    $("form1").reset();
    $("results").innerHTML = "";
    $("errors").innerHTML = "";
    $("StudentNo").focus();
};

function calculate() {
    $("errors").innerHTML = "";
    $("results").innerHTML = "";
    if ($("StudentNo").value === "") {
        $("errors").innerHTML = "Field cannot be blank." +
                                " Please enter a Student Number."; 
        $("StudentNo").focus();
        return;
    }
    if (isNaN($("StudentNo").value)) {
        $("errors").innerHTML = "Please enter a valid Student Number(It should not contain letters).";
        $("StudentNo").focus();
        return;
   }
    if ($("LastName").value === "") {
        $("errors").innerHTML = "Field cannot be blank." + 
                                " Please enter a Last Name.";
        $("LastName").focus();
        return;
    }
    if (!isNaN($("LastName").value)) {
        $("errors").innerHTML = "Please enter a valid Last Name.";
        $("LastName").focus();
        return;
    }
    if ($("FirstName").value === "") {
        $("errors").innerHTML = "Field cannot be blank." +
                                " Please enter a First Name.";
        $("FirstName").focus();
        return;
    }
    if (!isNaN($("FirstName").value)) {
        $("errors").innerHTML = "Please enter a valid First Name.";
        $("FirstName").focus();
        return;
    }
    
    var q1 = validateScore("Q1");
        if (q1 === -1) {return;}
    var q2 = validateScore("Q2");
        if (q2 === -1) {return;}
    var q3 = validateScore("Q3");
        if (q3 === -1) {return;}
    var q4 = validateScore("Q4");
        if (q4 === -1) {return;}
    var q5 = validateScore("Q5");
        if (q5 === -1) {return;}
    var qm = validateScore("Quiz_Make-Up");
        if (qm === -1) {return;}
    var mt = validateScore("MidTerm");
        if (mt === -1) {return;}
    var pr = validateScore("Problems");
        if (pr === -1) {return;}
    var fn = validateScore("Final");
        if (fn === -1) {return;}
 
    var qavg = quizAverage(q1, q2, q3, q4, q5, qm);
    var cavg = (qavg * .5) + (mt * .15) + (pr * .1) + (fn * .25);
    
    var lg;
    if (cavg >= 89.5) {
        lg = "A";
    } else if (cavg >= 79.5) {
        lg = "B";
    } else if (cavg >= 69.5) {
        lg = "C";
    } else if (cavg >= 59.5) {
        lg = "D";
    } else {
        lg = "F";
    }
    
    $("QzAvg").value = qavg.toFixed(1);
    $("CrsAvg").value = cavg.toFixed(1);
    $("LtrGrd").value = lg;
}

function validateScore(id) {
    var x = parseFloat($(id).value);
    if(isNaN(x) || x < 0 || x > 100) {
        $("errors").innerHTML = id + " must be a number from 0 to 100." +
                " If there is no score please enter 0.";
        $(id).value = "";
        $(id).focus();
        x = -1;
    }
    return x;
}

function quizAverage(q1, q2, q3, q4, q5, qm) {
    var qa = [q1,q2,q3,q4,q5,qm];
    qa.sort (function(a,b) {return a-b;});
    var qav = (qa[2] + qa[3] + qa[4] + qa[5]) / 4.0;
    return qav;
}