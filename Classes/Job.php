<?php

class Job {
    
    public $id, $clientId, $type, $dateCreated, $dateScheduled, $address, $priceEstimate, $priceCap, $notes, $status, $timePunches;
}

function getJobs($client){
    include_once 'Includes/Query.php';
    include_once 'Classes/Client.php';
    include_once 'Classes/TimePunch.php';
    include_once 'Classes/Address.php';
    
    $jobs = [];
    
    $sql = "SELECT jobs.*, status.name AS status, job_type.name AS type, address.* FROM jobs LEFT JOIN status ON jobs.status = status.id LEFT JOIN job_type ON jobs.jobType = job_type.id LEFT JOIN address ON jobs.address = address.id  WHERE clientId = '$client->id'";
    $res = query($sql);

    while($r = $res->fetch_assoc()){
        $job = new Job();
        
        $job->id = $r['id'];
        $job->type = $r['type'];
        $job->status = $r['status'];
        $job->clientId = $r['clientId'];
        $job->dateCreated = $r['dateCreated'];
        $job->dateScheduled = $r['dateScheduled'];
        $job->priceEstimate = $r['priceEstimate'];
        $job->priceCap = $r['priceCap'];
        $job->notes;
        $job->timePunches = getTimePunches($job);
        
        
        $address = new Address();
        $address->street = $r['street'];
        $address->city = $r['city'];
        $address->state = $r['state'];
        $address->zipcode = $r['zipcode'];
        
        $job->address = $address;
        
        array_push($jobs, $job);
    }
    
    return $jobs;
}
