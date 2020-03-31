<?php

$title = $this->title;
$player_id = $this->player_id;
$description = $this->description;
$data = $this->input("data");


$fields = array(
    'app_id' => "02c7f8dd-9d04-4fa6-aed7-0f49c72809b0",
    'included_segments' => array(
        'All'
    ),
    'contents' => [
        'en' => 'English Message'
    ],
    'title' => $title,
    'description' => $description,
    'data' => $data
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json; charset=utf-8',
    'Authorization: Basic ZTIzOTQ5MWEtZTczZi00Y2NjLWIzZDUtOTk0ZmQ0OWJlNDU1'
));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

$response = curl_exec($ch);

$this->setData("response", json_decode($response));
curl_close($ch);


$this->setData("fields", $fields);

?>;