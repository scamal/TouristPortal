<?php

function getIpAddress()
{

    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}


function getCountryByIp($ipAddress)
{
    $country = "unknown country";
    $url = "https://www.iplocate.io/api/lookup/{$ipAddress}";

    # Client URL Library  https://www.php.net/manual/en/book.curl.php
    # https://doc.bccnsoft.com/docs/php-docs-7-en/function.curl-setopt.html

    $curl = curl_init();
    # Initialize a cURL session
    curl_setopt($curl, CURLOPT_URL, $url);
    # The URL to fetch. This can also be set when initializing a session with curl_init().
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    #  	TRUE to return the transfer as a string of the return value of curl_exec() instead of outputting it out directly.
    curl_setopt($curl, CURLOPT_HEADER, false);
    #  	TRUE to include the header in the output.
    $details = json_decode(curl_exec($curl), true);
    # Perform a cURL session
    curl_close($curl);
    # Close a cURL session

    if (!empty($details['country'])) {
        $country = $details['country'];
    }
    return $country;
}

function insertIntoDevice($userAgent, $ipAddress, $country)
{

    global $connection;

    $sql = "INSERT INTO device(user_agent, ip_address, country, date_time) 
            VALUES ('$userAgent','$ipAddress','$country', now())";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    return mysqli_insert_id($connection);

}

function insertIntoMessage($id_device, $messageUser)
{

    global $connection;

    $sql = "INSERT INTO message(id_device, message) 
            VALUES ('$id_device','$messageUser')";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
}

function getStatisticData()
{
    global $connection;
    $data = [];

    $sql = "SELECT d.user_agent,d.ip_address,d.country,d.date_time,m.message
            FROM device d, message m
            WHERE d.id_device = m.id_device
            ORDER BY d.date_time DESC";

    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data[] = [
                "user_agent" => $record['user_agent'],
                "ip_address" => $record['ip_address'],
                "country" => $record['country'],
                "date_time" => $record['date_time'],
                "message" => $record['message']
            ];
        }
    }
    return $data;
}

function getMessage()
{
    global $connection;
    $data = [];

    $sql = "SELECT m.id_message,m.message, d.date_time, d.country 
            FROM message m, device d
            WHERE m.id_device = d.id_device AND m.showed = 0
            ORDER BY d.date_time ASC 
            LIMIT 0,1
            ";
    $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));

    if (mysqli_num_rows($result) > 0) {
        while ($record = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $data = [
                "footer" => 'From: ' . $record['country'] . ', sent on <cite title="Source Title">' . $record['date_time'] . '</cite>',
                "message" => $record['message']
            ];

            $id_message = $record['id_message'];
        }

        $sql = "UPDATE message SET showed =1
                    WHERE id_message = '$id_message'";

        $result = mysqli_query($connection, $sql) or die(mysqli_error($connection));
        $data['change'] = 1;

    } else {
        $data = [
            'message' => 'No new messages.',
            'footer' => 'we are waiting for messages.',
            'change' => 0
            ];
    }

    return $data;
}