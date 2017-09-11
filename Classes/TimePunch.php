<?php

class TimePunch {
    public $id, $jobId, $employee, $dateIn, $dateOut;
}

function getTimePunches($job){
    include_once 'Includes/Query.php';
    
    $punchcards = [];
    
    $sql = "SELECT * FROM time_punches WHERE jobId = '$job->clientId'";
    $res = query($sql);

    while($r = $res->fetch_assoc()){
        $punchcard = new TimePunch();
        
        $punchcard->id = $r['id'];
        $punchcard->jobId = $r['jobId'];
        $punchcard->employee = $r['employeeId'];
        $punchcard->dateIn = $r['timeIn'];
        $punchcard->dateOut = $r['timeOut'];
        
        array_push($punchcards, $punchcard);
    }
    return $punchcards;
}
