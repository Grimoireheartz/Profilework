<?php
include 'server.php';
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: *");


if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;

    exit;
}

if (!$link->set_charset("utf8")) {
    printf("Error loading character set utf8: %s\n", $link->error);
    exit();
}

echo 'Receive_data_for_isite';


$sql_delete = "DELETE FROM bsc_isite_machineutilize";
$result_delete = mysqli_query($link, $sql_delete);


$data = json_decode(file_get_contents('php://input'), true);

$serial =   $data["serial"];
$cussite = $data['cussite'];
$utiliz = $data['utiliz'];
$contract = $data['contract'];
$family = $data['family'];
$model = $data['model'];
$lastup = $data['lastup'];

$serial_arr  = explode(',', $serial);
$cussite_arr  = explode(',', $cussite);
$utiliz_arr = explode(',', $utiliz);
$contract_arr = explode(',', $contract);
$family_arr = explode(',', $family);
$model_arr = explode(',', $model);
$lastup_arr = explode(',', $lastup);

for ($x = 0; $x < (count($serial_arr) - 1); $x++) {

    $sql_insert_quotreq = "INSERT INTO bsc_isite_machineutilize 
                                        (serialmachine,text_cussite,utilization,owner,machinefamily,
                                        model,last_update) 
                            VALUES ('$serial_arr[$x]','$cussite_arr[$x]','$utiliz_arr[$x]','$contract_arr[$x]','$family_arr[$x]',
                            '$model_arr[$x]','$lastup_arr[$x]')";
    $result = mysqli_query($link, $sql_insert_quotreq);
}


$status = 'success';
$response = 'Save already';


echo json_encode(array("status" => $status, "response" => $response));

// if (isset($_GET)) {
//     if ($_GET['apikey'] == $bsc_db_apikey) {


//     } else echo "btserviceconnect_requestregis";
// }


mysqli_close($link);
