<?php
  
function httpClient($url_path,$data,$method="GET") {
        // Contains the url to post data
    // this is my local server url
    // demo is the folder name and
    // demo1.php is other file
    
    // Data is an array of key value pairs
    // to be reflected on the site
    
    // Method specified whether to GET or
    // POST data with the content specified
    // by $data variable. 'http' is used
    // even in case of 'https'
    
    $options = array(
        'http' => array(
        'method' => $method,
        'content' => http_build_query($data))
    );
    
    // Create a context stream with
    // the specified options
    $stream = stream_context_create($options);
    
    // The data is stored in the 
    // result variable
    $result = file_get_contents(
            $url_path. '?'. http_build_query($data));
    
    return $result;
}
?>