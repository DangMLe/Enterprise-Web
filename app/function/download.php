<?php

include_once('zip.php');
include('connection.php');
$SubmitID = $_POST['SubmitID'];
$sql = "SELECT*from SubmitFiles where SubmitID = '$SubmitID'";
$result = $conn->query($sql);  
$row = $result->fetch_assoc(); 
$zip_file = 'my_files.zip'; // name for downloaded zip file

$ziper = new zipfile();
$ziper->prefix_name = 'folder/'; // here you create folder which will contain downloaded files
$ziper->addFiles($row["FilePath"]);  // array of files
$ziper->output($zip_file); 
$ziper->forceDownload($zip_file);
@unlink($zip_file);

?>