<?php

    // read the raw post data
    // Suported URL: http://stackoverflow.com/questions/22188974/ios-send-json-data-in-post-request-using-nsjsonserialization

$handle = fopen("php://input", "rb");
    $raw_post_data = '';
    while (!feof($handle)) {
        $raw_post_data .= fread($handle, 8192);
    }
    fclose($handle); 

   // echo $raw_post_data;
    // decode the JSON into an associative array
    
    $request = json_decode($raw_post_data, true);
    
    // you can now access the associative array, $request
    
    if (isset($request['message'] )) {
    	$response['success'] = true;
    } else {
    	$response['success'] = false;
    }
    
    // I don't know what else you might want to do with `$request`, so I'll just throw
    // the whole request as a value in my response with the key of `request`:
    
    $response['request'] = $request;
    
    $raw_response = json_encode($response);
    
    // specify headers
    
    header("Content-Type: application/json");
    header("Content-Length: " . strlen($raw_response));
    
    // output response
    
    echo $raw_response;
    
?>