<?php

class Client {
    Public $id, $firstName, $lastName, $address, $homePhone, $cellPhone, $email, $notes, $jobs;
}

function getClient($lastName){
    include_once 'Includes/Query.php';
    include 'Classes/Address.php';
    include 'Classes/Job.php';

    $sql = "SELECT clients.*, address.* FROM clients LEFT JOIN address ON clients.address = address.id WHERE clients.lastName = '$lastName'";
    $res = query($sql);

    while($r = $res->fetch_assoc()){
        $client = new Client();
        $address = new Address();
        
        try{
            $address->street = $r['street'];
            $address->city = $r['city'];
            $address->state = $r['state'];
            $address->zipcode = $r['zipcode'];
        }
        catch (Exception $e){

        }

        $client->id = $r['id'];
        $client->firstName = $r['firstName'];
        $client->lastName = $r['lastName'];
        $client->address = $address;
        $client->homePhone = $r['homePhone'];
        $client->cellPhone = $r['cellPhone'];
        $client->email = $r['email'];

        $client->jobs = getJobs($client);
        
        return $client;
    }
    return false;
}
