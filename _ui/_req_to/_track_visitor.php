<?php
date_default_timezone_set("Asia/Kolkata");
$t = time();

header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');


if(isset($_GET)){
    $api_url = "http://ip-api.com/json/".$_SERVER['REMOTE_ADDR'];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $api_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $result = curl_exec($ch);
    $result = json_decode($result);

    function generateRandomString($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    if($result->status == "success"){

        include('../../_config/_conn.php');

        $track_id = generateRandomString(34);

        $query = $result->query;
        $country = $result->country;
        $countryCode = $result->countryCode;
        $region = $result->region;
        $regionName = $result->regionName;
        $city = $result->city;
        $isp = $result->isp;
        
        $current_url = $_GET['url'];

        $kolkata_time = date('Y-m-d H:i:s',$t);

        $sql = "INSERT INTO `traffic_track` (`t_id`, `ip`, `current_url`, `country`, `countryCode`, `region`, `regionName`, `city`, `isp`, `visited_at`) VALUES ('$track_id', '$query', '$current_url', '$country', '$countryCode', '$region', '$regionName', '$city', '$isp', '$kolkata_time')";
        $result = mysqli_query($conn, $sql);
        if($result){
            $json_array = array();
            $json_array[] = array(
                "status" => "success",
                "message" => "Visitor tracked"
            );
            echo json_encode($json_array, JSON_PRETTY_PRINT);
        }else{
            $json_array = array();
            $json_array[] = array(
                "status" => "error",
                "message" => "Tracking error"
            );
            echo json_encode($json_array, JSON_PRETTY_PRINT);
        }
    }else{
        $json_array = array();
        $json_array[] = array(
            "status" => "error",
            "message" => "IP api error"
        );
        echo json_encode($json_array, JSON_PRETTY_PRINT);
    }
}else{
    $json_array = array();
    $json_array[] = array(
        "status" => "error",
        "message" => "Invalid request"
    );
    echo json_encode($json_array, JSON_PRETTY_PRINT);
}

?>