<?php
require_once('lib/nusoap.php');

class Tender_Information
{
    public function category()
    {
        $wsdl = "http://localhost:8095/project/php-webservices/webservice-server.php?wsdl";
        $client = new nusoap_client($wsdl, true);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2>' . $err;
            exit();
        }
        try {
            $results = $client->call('Te_Category', array('column_name' => '', 'query' => ''));
            $result = json_decode($results);
            echo '<pre>';
            print_r($result);
            die();
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function SubCategory()
    {
        $wsdl = "http://localhost:8095/project/php-webservices/webservice-server.php?wsdl";
        $client = new nusoap_client($wsdl, true);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2>' . $err;
            exit();
        }
        try {
            $results = $client->call('Te_SubCategory', array('column_name' => '', 'query' => ''));
            $result = json_decode($results);
            echo '<pre>';
            print_r($result);
            die();
        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function Company()
    {
        $wsdl = "http://localhost:8095/project/php-webservices/webservice-server.php?wsdl";
        $client = new nusoap_client($wsdl, true);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2>' . $err;
            exit();
        }
        try {
            $results = $client->call('Te_Company', array('column_name' => '', "query" => ""));
            $result = json_decode($results);

            echo '<pre>';
            print_r($result);
            die();

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function country()
    {
        $wsdl = "http://localhost:8095/project/php-webservices/webservice-server.php?wsdl";
        $client = new nusoap_client($wsdl, true);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2>' . $err;
            exit();
        }
        try {
            $results = $client->call('Te_countryUnited', array('column_name' => '', "query" => ""));
            $result = json_decode($results);

            echo '<pre>';
            print_r($result);
            die();

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function estelambaha()
    {
        $wsdl = "http://localhost:8095/project/php-webservices/webservice-server.php?wsdl";
        $client = new nusoap_client($wsdl, true);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2>' . $err;
            exit();
        }
        try {
            $results = $client->call('Te_Estelam', array('column_name' => '', "query" => ""));
            $result = json_decode($results);

            echo '<pre>';
            print_r($result);
            die();

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function TenderList()
    {
        $wsdl = "http://localhost:8095/project/php-webservices/webservice-server.php?wsdl";
        $client = new nusoap_client($wsdl, true);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2>' . $err;
            exit();
        }
        try {
            $results = $client->call('Te_TenderList', array('column_name' => '', "query" => ""));
            $result = json_decode($results);

            echo '<pre>';
            print_r($result);
            die();

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

    public function GetNerkh()
    {
        $wsdl = "http://localhost:8095/project/php-webservices/webservice-server.php?wsdl";
        $client = new nusoap_client($wsdl, true);

        $err = $client->getError();
        if ($err) {
            echo '<h2>Constructor error</h2>' . $err;
            exit();
        }
        try {
            $results = $client->call('Te_GetNerkh', array('column_name' => '', "query" => ""));
            $result = json_decode($results);

            echo '<pre>';
            print_r($result);
            die();

        } catch (Exception $e) {
            echo 'Caught exception: ', $e->getMessage(), "\n";
        }
    }

}

$ob = new Tender_Information();
$ob -> category();
//$ob -> SubCategory();
//$ob -> Company();
//$ob -> country();
//$ob -> estelambaha();
//$ob -> TenderList();
//$ob -> GetNerkh();