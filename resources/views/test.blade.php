<x-layout>
    <h1>hellp world</h1>

<?php

    // $user_id = 210700286;

    // $info = file_get_contents('https://api.vk.com/method/users.get.json?user_ids='.$user_id.'&fields=bdate&v=5.68');
    // $info = json_decode($info, true);
    // print_r($info);


    $sURL = "http://brugbart.com/Examples/http-post.php"; // URL-адрес POST 
$sPD = "name=Jacob&bench=150"; // Данные POST
$aHTTP = array(
  'http' => // Обертка, которая будет использоваться
    array(
    'method'  => 'POST', // Метод запроса
    // Ниже задаются заголовки запроса
    'header'  => 'Content-type: application/x-www-form-urlencoded',
    'content' => $sPD
  )
);
$context = stream_context_create($aHTTP);
$contents = file_get_contents($sURL, false, $context);
echo $contents;

?>

</x-layout>