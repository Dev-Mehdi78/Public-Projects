<?php
/*+**********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.0
 * ("License"); You may not use this file except in compliance with the License
 * The Original Code is:  vtiger CRM Open Source
 * The Initial Developer of the Original Code is vtiger.
 * Portions created by vtiger are Copyright (C) vtiger.
 * All Rights Reserved.
 ************************************************************************************/
//http://my.candoosms.com/services/URLService/URN?username=farataz20&password=2042asabak&command=send&src=200002357005&destinations=09358041053,09386070346&body=test&flash=0
class SMSNotifier_candoosms_Provider implements SMSNotifier_ISMSProvider_Model
{
    private $username;
    private $password;
    private $parameters = array();
    private $client = null;

    const SERVICE_URI = 'http://my.candoosms.com/services/URLService/URN';
    private static $REQUIRED_PARAMETERS = array('from');

    /**
     * Function to get provider name
     * @return <String> provider name
     */
    public function getName()
    {
        return 'candoosms';
    }

    /**
     * Function to get required parameters other than (username, password)
     * @return <array> required parameters list
     */
    public function getRequiredParams()
    {
        return self::$REQUIRED_PARAMETERS;
    }

    /**
     * Function to get service URL to use for a given type
     * @param <String> $type like SEND, PING, QUERY
     */
    public function getServiceURL($type = false)
    {
        if ($type) {
            switch (strtoupper($type)) {
                case 'SOAP':
                    return 'https://new.payamsms.com/services/v2/?wsdl';
            }
        }
        return false;
    }

    /**
     * Function to set authentication parameters
     * @param <String> $username
     * @param <String> $password
     */
    public function setAuthParameters($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * Function to set non-auth parameter.
     * @param <String> $key
     * @param <String> $value
     */
    public function setParameter($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * Function to get parameter value
     * @param <String> $key
     * @param <String> $defaultValue
     * @return <String> value/$default value
     */
    public function getParameter($key, $defaultValue = false)
    {
        if (isset($this->parameters[$key])) {
            return $this->parameters[$key];
        }
        return $defaultValue;
    }

    /**
     * Function to prepare parameters
     * @return <Array> parameters
     */
    protected function prepareParameters()
    {
        $params = array(
            'username' => $this->username,
            'password' => $this->password
        );
        foreach (self::$REQUIRED_PARAMETERS as $key) {
            $params[$key] = $this->getParameter($key);
        }
        return $params;
    }

    /**
     * Function to handle SMS Send operation
     * @param <String> $message
     * @param <Mixed> $toNumbers One or Array of numbers
     */
    public function send($message, $toNumbers)
    {
        if (!is_array($toNumbers)) {
            $toNumbers = array();
        }
        $param = $this->prepareParameters();
        $params = array(
            'username'=> $this->username,
            'password'=> $this->password,
            'from'=> $param['from'],
            'to'=> implode(',' , $toNumbers),
            'text'=> urlencode($message)
        );

        $URL = self::SERVICE_URI.'?username='.$params['username'].'&password='.$params['password'].'&command=send&src='.$params['from'].'&destinations='.$params['to'].'&body='.$params['text'].'&flash=0';

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $URL,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $response = str_replace(array('-END' , '--BEGIN' , '-') , '' , $response);
        $response = strpos($response ,"E5");

        $results = array();
        if($response == null ){
            $result['status'] = 'Successfull';
            $result['statusmessage'] = 'ارسال با موفقیت انجام شد';
        }else{
            $result['status'] = 'Failed';
            $result['statusmessage'] = 'خطا در ارسال پیام';
        }

        $results[] = $result;

        //echo "<pre>";die(print_r($results));

        return $results;
    }

    /**
     * Function to get query for status using messgae id
     * @param <Number> $messageId
     */
    public function query($messageId)
    {
        $error                   = false;
        $result                  = array();
        $result['statusmessage'] = "Delivery Web Service Not working on SabaSMS";
        $result['id']            = $messageId;
        $result['status']        = 'Processing';
        $result['needlookup']    = 0;
        return $result;
    }

    /**
     * Function to Correct SMS Receiver Number
     * @param <Number> $uNumber
     */
    public function CorrectNumber($uNumber)
    {
        $uNumber = Trim($uNumber);
        $ret =& $uNumber;

        if (substr($uNumber, 0, 3) == '%2B') {
            $ret     = substr($uNumber, 3);
            $uNumber = $ret;
        }

        if (substr($uNumber, 0, 3) == '%2b') {
            $ret     = substr($uNumber, 3);
            $uNumber = $ret;
        }

        if (substr($uNumber, 0, 4) == '0098') {
            $ret     = substr($uNumber, 4);
            $uNumber = $ret;
        }

        if (substr($uNumber, 0, 3) == '098') {
            $ret     = substr($uNumber, 3);
            $uNumber = $ret;
        }


        if (substr($uNumber, 0, 3) == '+98') {
            $ret     = substr($uNumber, 3);
            $uNumber = $ret;
        }

        if (substr($uNumber, 0, 2) == '98') {
            $ret     = substr($uNumber, 2);
            $uNumber = $ret;
        }

        if (substr($uNumber, 0, 1) == '0') {
            $ret     = substr($uNumber, 1);
            $uNumber = $ret;
        }

        return '+98' . $ret;
    }

    /**
     * Function to Call Soap Webservice
     * @params <String> $method, <Array> $params
     */
    public function call($method, $params)
    {
        if ($this->CheckSOAP()) {
            $serviceURL                     = self::getServiceURL('SOAP');
            $this->client                   = new SoapClient($serviceURL, array(
                'trace' => true
            ));
            $this->client->soap_defencoding = 'UTF-8';
            $this->client->decode_utf8      = true;
            $result                         = $this->client->__soapCall($method,$params);
            $this->client->__getLastRequest();

            if (is_soap_fault($result)) {
                return array(
                    array(
                        'uid' => 'Error',
                        'state' => $result['status_message']
                    )
                );
            }
        }

        if ($result['status'] === 0){
            return array(
                array(
                    'uid' => isset($result['identifiers'][0])?$result['identifiers'][0]:1,
                    'state' => 'done'
                )
            );
        } else {
            return array(
                array(
                    'uid' => 'error',
                    'state' => $result['status_message']
                )
            );
        }
    }

    /**
     * Function to Check PHP Extensions
     */
    public function CheckSOAP()
    {
        return (extension_loaded('soap') ? true : false);
    }

    /**
     * Function to prepare Webservice Post Fields
     * @params <Array> $params
     */
    public function preparePostFields($params)
    {
        if ($this->CheckSOAP()) {
            return $params;
        } else {
            $querystring = "";
            foreach ($params AS $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $value) {
                        $querystring .= $k . "[]=" . urlencode($value) . "&";
                    }
                } else {
                    $querystring .= "$k=" . urlencode($v) . "&";
                }
            }
        }
        return $querystring;
    }
}