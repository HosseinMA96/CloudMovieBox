<?php
$servername = "sql109.ihweb.ir";
$username = "ihweb_31084399";
$password = "17m3fsnt";
$dbname= "ihweb_31084399_main";
// Create connection
$conn = new mysqli($servername, $username, $password,$dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
 $author_name=null;
// echo "Connected successfully <br>";
//<form action="first.php" method="post" enctype= multipart/form-data>

echo "<h3>comments for movie ".$_GET["film_name"]."</h3><br>";
?>

<html>                   
    <body>                   
     <form action="first.php?film_name=<?php echo $_GET['film_name'] ?>" method="post" enctype= multipart/form-data>
     <input type="file"  name="file" >
     <input type="text" name="author_name">

     <input type="submit" value="upload">
     </form>
    

    <?php 
    $author_name=$_POST["author_name"];
    // echo $author_name."<br>";
           

    if (isset($_FILES['file'])){
        $file=$_FILES['file'];
        // print_r($file);

        $file_name=$file['name'];
        $file_tmp=$file['tmp_name'];
        $file_size=$file['size'];
        $file_error=$file['error'];

        //file extension
        $file_ext=explode('.',$file_name);
        $file_ext=strtolower(end($file_ext));

        $allowed=array('mp3','wav','pdf');



        // if(in_array($file_ext,$allowed)){
            if($file_error == 0 ){
                // echo "no error <br>";
                $file_dest='uploads/'. $file_name;

                if(move_uploaded_file($file_tmp,$file_dest))
                {
                    // echo "new file destination : ".$file_dest;
                    $abcd=2;
                }
            }
        // }
        
    }

    // Generated by curl-to-PHP: http://incarnate.github.io/curl-to-php/
$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://api.us-south.speech-to-text.watson.cloud.ibm.com/instances/fd2c1d8f-3fba-48aa-846c-f0b4d603b724/v1/recognize');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);

// $file = file_get_contents('uploads/attempt.mp3'); 
$file = file_get_contents($file_dest); 
$post = array(
    'file' => $file
);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_USERPWD, 'apikey' . ':' . 'tHAgvjDUsK0m4AYLUNIKo1WkfuDIyPF3eFd9bpZkpLQ4');

$headers = array();
$headers[] = 'Content-Type: audio/mpeg';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error :' . curl_error($ch);
}

$decode=json_decode($result, true);
curl_close($ch);
$comment=$decode["results"][0]["alternatives"][0]["transcript"];
// echo "comment : ".$comment."<br>"; 



////////////////////////////
// echo $result." fuck <br> ";
// echo gettype($result)."<br>"; 
// echo strlen($result)."<br>;"
// $decode=json_decode($result, true);
// echo gettype($decode)."<br>"; 
// echo count($decode)."<br>"; 

// echo gettype($decode["results"])."<br>"; 
// echo count($decode["results"])."<br>"; 
// echo $decode["results"][0]."<br>"; 
// echo count($decode["results"][0])."<br>"; 
// $comment=$decode["results"][0]["alternatives"][0]["transcript"];
// echo "comment : ".$comment."<br>"; 
// echo count($decode)."<br>"; 
// $decode=json_decode($result['results'], true);
// echo gettype($decode)."<br>"; 
// echo $decode['results']['alternatives']." wait <br>"; 
// // echo count($result);
///////////////////////////
// $author_text=$comment;
$author_text=str_replace("'","\'",$comment);
//check the politness
$url = "https://api.au-syd.natural-language-understanding.watson.cloud.ibm.com/instances/970a10a4-acb9-420e-ada3-9fd7b63c9cc1/v1/analyze?version=2019-07-12";

$curl = curl_init($url);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$headers = array(
    "Content-Type: application/json",
    "Authorization: Basic YXBpa2V5OmZYRG5WaUQ1bEZYRkRqeEs1S2FYMUluYWNqOUZaQzA3Zy1XZlByZGVrVUJq",
);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

$data = '{
  "text": "' . preg_replace('/\s+/', ' ', $author_text) . '",
  "features": {
    "sentiment": {},
    "categories": {},
    "concepts": {},
    "entities": {},
    "keywords": {
    "emotion": true
    }
  }
}';

curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

$resp = curl_exec($curl);
curl_close($curl);
// echo $resp."<br>";
$json_response = json_decode($resp, true);
// var_dump($json_response);
// echo "<br><br>";

$anger=$json_response["keywords"][0]["emotion"]["anger"];
// echo $anger."<br>";

// echo gettype($anger)."<br>";

if ($anger > 0.4) {
    echo "Comment was too angry! <br>";
}

elseif ( $author_name != null)
{
    //  $author_text=implode(" ",$author_text);

   

    $sql = "INSERT INTO comments (film,name, text)
VALUES ('" . $_GET["film_name"] . "','" . $author_name . "','" . $author_text . "')";

// echo "<br> film name : ". $_GET["film_name"]."<br>";

if ($conn->query($sql) === TRUE) 
{

  echo "comment was added successfully";

} 
else
 {
  echo "Error: " . $sql . "<br>" . $conn->error;
}


}
$conn->close();
?>
    </body>
</html>



