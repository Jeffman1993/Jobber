<?php

include 'Classes/Client.php';

$client = getClient($_GET['n']);

if($client){
    $address = $client->address;
    $jobs = $client->jobs;
    $job = $jobs[0];
    $jobAdd = $job->address;
    $punches = $job->timePunches;

    echo "<strong>Name:</strong> $client->firstName $client->lastName<br>";
    echo "<strong>Address:</strong> $address->street, $address->city, $address->state $address->zipcode<br>";
    echo "<strong>Home Phone:</strong> $client->homePhone<br>";
    echo "<strong>Cellphone:</strong> $client->cellPhone<br>";
    echo "<strong>Email:</strong> $client->email<br>";
    
    echo "<br><strong>Type:</strong> $job->type<br>";
    echo "<strong>Status:</strong> $job->status<br>";
    echo "<strong>Date Created:</strong> $job->dateCreated<br>";
    echo "<strong>Scheduled:</strong> $job->dateScheduled<br>";
    echo "<strong>Address:</strong> $jobAdd->street, $jobAdd->city, $jobAdd->state $jobAdd->zipcode<br>";
    echo "<strong>Estimate:</strong> $job->priceEstimate<br>";
    echo "<strong>Cap:</strong> $job->priceCap<br>";
}
 else {
        echo "Unknown Client Named $_GET[n].";
}
?>

