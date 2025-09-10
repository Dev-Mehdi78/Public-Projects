<?php




ini_set("display_errors", 1);
ini_set('error_reporting', E_ERROR);

require_once('dbconn.php');
require_once('lib/nusoap.php');

    $server = new nusoap_server();

function Te_Category($column_name = null , $query = null){
    global $dbconn;
    $query = mysqli_set_charset($dbconn, 'utf8');
    if ($column_name == null){
        $sql = "SELECT * FROM `category` $query ";
    }else{
        $sql = "SELECT $column_name FROM `category` $query ";
    }

    // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':query'  , $query );
    $stmt->bindParam(':column_name' , $column_name);

    // insert a row
    $stmt->execute();
    if ($stmt -> rowCount($sql) > 0){
        $resArray[] = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($resArray , $data);
        }
    }
    return json_encode($resArray , true);
    $dbconn = null;
}

function Te_SubCategory($column_name = null , $query = null){
    global $dbconn;

    if ($column_name == null){
        $sql = "SELECT * FROM `subcategory` $query ";
    }else{
        $sql = "SELECT $column_name FROM `subcategory` $query ";
    }

    // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':query'  , $query );
    $stmt->bindParam(':column_name' , $column_name);

    // insert a row
    $stmt->execute();
    if ($stmt -> rowCount($sql) > 0){
        $resArray[] = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($resArray , $data);
        }
    }
    return json_encode($resArray , true);
    $dbconn = null;
}


function Te_Company($column_name = null , $query = null){
    global $dbconn;

    if ($column_name == null){
        $sql = "SELECT * FROM `company` $query";
    }else{
        $sql = "SELECT `$column_name` FROM `company` $query";
    }

    // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':query'  , $query );
    $stmt->bindParam(':column_name' , $column_name);
    // insert row
    $stmt->execute();
    $num_rows = $stmt -> rowCount($sql);

    if ($num_rows > 0){
        $resArray[] = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
                    array_push($resArray , $data);
        }
    }
    return json_encode($resArray , true);
    $dbconn = null;
}

function Te_countryUnited($column_name = null , $query = null){
    global $dbconn;

    if ($column_name == null){
        $sql = "SELECT * FROM `countryunited` $query";
    }else{
        $sql = "SELECT `$column_name` FROM `countryunited` $query";
    }

    // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':query'  , $query );
    $stmt->bindParam(':column_name' , $column_name);
    // insert row
    $stmt->execute();
    $num_rows = $stmt -> rowCount($sql);

    if ($num_rows > 0){
        $resArray[] = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($resArray , $data);
        }
    }
    return json_encode($resArray , true);
    $dbconn = null;
}

function Te_Estelam($column_name = null , $query = null){
    global $dbconn;

    if ($column_name == null){
        $sql = "SELECT * FROM `estelambaha` $query";
    }else{
        $sql = "SELECT `$column_name` FROM `estelambaha` $query";
    }

    // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':query'  , $query );
    $stmt->bindParam(':column_name' , $column_name);
    // insert row
    $stmt->execute();
    $num_rows = $stmt -> rowCount($sql);

    if ($num_rows > 0){
        $resArray[] = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($resArray , $data);
        }
    }
    return json_encode($resArray , true);
    $dbconn = null;
}

function Te_TenderList($column_name = null , $query = null){
    global $dbconn;

    if ($column_name == null){
        $sql = "SELECT * FROM `listmonaghese` $query";
    }else{
        $sql = "SELECT `$column_name` FROM `listmonaghese` $query";
    }

    // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':query'  , $query );
    $stmt->bindParam(':column_name' , $column_name);
    // insert row
    $stmt->execute();
    $num_rows = $stmt -> rowCount($sql);

    if ($num_rows > 0){
        $resArray[] = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($resArray , $data);
        }
    }
    return json_encode($resArray , true);
    $dbconn = null;
}

function Te_GetNerkh($column_name = null , $query = null){
    global $dbconn;

    if ($column_name == null){
        $sql = "SELECT * FROM `getnerkh` $query";
    }else{
        $sql = "SELECT `$column_name` FROM `getnerkh` $query";
    }

    // prepare sql and bind parameters
    $stmt = $dbconn->prepare($sql);
    $stmt->bindParam(':query'  , $query );
    $stmt->bindParam(':column_name' , $column_name);
    // insert row
    $stmt->execute();
    $num_rows = $stmt -> rowCount($sql);

    if ($num_rows > 0){
        $resArray[] = array();
        while ($data = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($resArray , $data);
        }
    }
    return json_encode($resArray , true);
    $dbconn = null;
}


$server->configureWSDL('IranTenderServer', 'urn:IranTender');

$server->register('Te_Category',
    array('column_name' => 'xsd:string' , 'query' => 'xsd:string'),  //parameter
    array('data' => 'xsd:string'),  //output
    'urn:IranTender',   //namespace
    'urn:IranTender#Te_Company' //soapaction
);

$server->register('Te_SubCategory',
    array('column_name' => 'xsd:string' , 'query' => 'xsd:string'),  //parameter
    array('data' => 'xsd:string'),  //output
    'urn:IranTender',   //namespace
    'urn:IranTender#Te_Company' //soapaction
);

$server->register('Te_Company',
    array('column_name' => 'xsd:string' , 'query' => 'xsd:string'),  //parameter
    array('data' => 'xsd:string'),  //output
    'urn:IranTender',   //namespace
    'urn:IranTender#Te_Company' //soapaction
);

$server->register('Te_countryUnited',
    array('column_name' => 'xsd:string' , 'query' => 'xsd:string'),  //parameter
    array('data' => 'xsd:string'),  //output
    'urn:IranTender',   //namespace
    'urn:IranTender#Te_Company' //soapaction
);

$server->register('Te_Estelam',
    array('column_name' => 'xsd:string' , 'query' => 'xsd:string'),  //parameter
    array('data' => 'xsd:string'),  //output
    'urn:IranTender',   //namespace
    'urn:IranTender#Te_Company' //soapaction
);

$server->register('Te_TenderList',
    array('column_name' => 'xsd:string' , 'query' => 'xsd:string'),  //parameter
    array('data' => 'xsd:string'),  //output
    'urn:IranTender',   //namespace
    'urn:IranTender#Te_Company' //soapaction
);

$server->register('Te_GetNerkh',
    array('column_name' => 'xsd:string' , 'query' => 'xsd:string'),  //parameter
    array('data' => 'xsd:string'),  //output
    'urn:IranTender',   //namespace
    'urn:IranTender#Te_Company' //soapaction
);


$server->service(file_get_contents("php://input"));
Te_Company('' , '');