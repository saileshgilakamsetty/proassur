<?php
require 'vendor/autoload.php';

// Data Array
$tokenData = array(
    'firstName'=>"Farhad",
    'userName' => "Farhad Zaman",
    'profilePicture'=>"http://pprofilePic/1234.jpg",
    'userEmail' => "abcd@gmail.com",
    'userId' => 12,
);

$client = new \GuzzleHttp\Client();

    $response = $client->request('POST', 'http://localhost/im-messenger/registration/create_jwt_token', [
        'json' =>$tokenData,   // sending array as JSON
        'verify' => false // ssl verify false
        ]
    );

$jwtToken = $response->getBody();
echo $jwtToken;
?>


<script>
    localStorage._r= <?php echo $jwtToken ?>;
</script>