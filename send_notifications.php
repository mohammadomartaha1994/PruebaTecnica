<?php 
    include 'conn.php';
    
    $title=$_POST['name'];
    $message=$_POST['name'] . " Desctiption";
    
    define( 'API_ACCESS_KEY', 'AAAA_kqRICs:APA91bG0qGUnAKetaqTrMs4tZnZIYNFlvMdApNKq2sf_ukyBs77ffWIjdfdWAzOpu-I3bcsx7vlVCogoDwfuq3bztyVFWffbLLYfU-mwhTlyOgo9LPCNp4gcRr5NP1Bh5VtzZPOJvdBS');
$msg = array
(
    'body'=>$message,
    'title'=> $title,
);

$arrayOfTokens = array();
$sql = "SELECT DISTINCT Code FROM `fcm`";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
       array_push($arrayOfTokens,$row['Code']);
       }   
}

print_r($arrayOfTokens);

$fields = array
(
    'registration_ids'=> $arrayOfTokens,
    'notification'=> $msg
);

$headers = array
(
    'Authorization: key='.API_ACCESS_KEY,
    'Content-Type: application/json'
);

$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
$result = curl_exec($ch );
curl_close( $ch );


$url = 'send_notifications.html';                
header( "Location: $url" );

?>  
