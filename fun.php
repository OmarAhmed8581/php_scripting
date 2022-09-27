<?php 


require_once('connection.php'); 

header("Access-Control-Allow-Origin: *");
header('Content-type: application/json');

$type=$_GET["type"];

if($type=="view"){
    $status=array();
    $sql="SELECT source_id,source_name, source_url , source_begin , source_end  , parsed_dtm FROM `source` ";
    $result = $conn->query($sql);
    $source_id=0;
    if ($result->num_rows > 0) {
    // output data of each row

        while($row = $result->fetch_assoc()) {
            $temp=array();
            array_push($temp,$row["source_id"]);
            array_push($temp,$row["source_name"]);
            array_push($temp,$row["source_url"]);
            array_push($temp,$row["source_begin"]);
            array_push($temp,$row["source_end"]);
            array_push($temp,$row["parsed_dtm"]);
            array_push($status,$temp);

        }
        echo json_encode($status);
    } else {
    echo "0 results";
    }
}
else{
    $id=$_GET["id"];
    $sql="SELECT count(*) as count FROM `occurrence` where source_id=$id ";
    $result = $conn->query($sql);
    $count=0;
    if ($result->num_rows > 0) {
    // output data of each row

        while($row = $result->fetch_assoc()) {
           $count=$row["count"];

        }
        // echo json_encode($status);
    } else {
    echo "0 results";
    }

    $status=array();
    $sql="SELECT word,freq FROM `occurrence` where source_id=$id ";
    $result = $conn->query($sql);
    $source_id=0;
    if ($result->num_rows > 0) {
    // output data of each row

        while($row = $result->fetch_assoc()) {
            $temp=array();
            array_push($temp,$row["word"]);
            array_push($temp,$row["freq"]);
            $cal = round(100 * ($row["freq"]/$count),2);
            array_push($temp,$cal);
            array_push($status,$temp);

        }
        echo json_encode($status);
    } else {
    echo "0 results";
    }

}

























?>