<?php
    
    if ( !isset($_POST['content']) || $_POST['content']=="" ){
        echo "Missing content!";
        exit();
    }

    $data = array(
        'description' => $_POST['desc'],
        'public' => 1,
        'files' => array(
            $_POST['filename'] => array('content' => $_POST['content']),
        ),
    );                               
    $data_string = json_encode($data);

    $url = 'https://api.github.com/gists';
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch,CURLOPT_USERAGENT,'daconex');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $decoded = json_decode($response, TRUE);
    $gistlink = $decoded['html_url'];

    echo '<a href="'.$gistlink.'">'.$gistlink.'</a>';    