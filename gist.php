<?php

if (isset($_POST['button'])) 
{    
    $code = $_POST['code'];

    $data = array(
        'description' => 'description for your gist',
        'public' => 1,
        'files' => array(
            'foo.php' => array('content' => 'sdsd'),
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

echo $response;
    $decoded = json_decode($response, TRUE);
    $gistlink = $decoded['html_url'];

    echo $gistlink;    
}
?>

<form action="gist.php" method="post">
Code: 
<textarea name="code" cols="25" rows="10"/> </textarea>
<input type="submit" name="button"/>
</form>