<?php

$conn = mysqli_connect("localhost", "root", "", "excel");

if (mysqli_connect_errno($conn)) {
    die("no");
}

ini_set("display_errors", 1);
ini_set('error_reporting', E_ERROR);
require_once 'excel_reader2.php';

$data = new Spreadsheet_Excel_Reader("aval-ir.xls");

for ($i = 0; $i < count($data->sheets); $i++) // Loop to get all sheets in a file.
{
    if (count($data->sheets[$i]['cells']) > 0) // checking sheet not empty
    {
        for ($j = 2; $j <= count($data->sheets[$i]['cells']); $j++) // loop used to get each row of the sheet
        {
            $web_address = "";
            if (isset($data->sheets[$i]['cells'][$j][1])) {
                $web_address = $data->sheets[$i]['cells'][$j][1];
            } else {
                $web_address = "";
            }
            $status_code = "";
            if (isset($data->sheets[$i]['cells'][$j][2])) {
                $status_code = $data->sheets[$i]['cells'][$j][2];
            } else {
                $status_code = "";
            }

            $status = "";
            if (isset($data->sheets[$i]['cells'][$j][3])) {
                $status = $data->sheets[$i]['cells'][$j][3];
            } else {
                $status = "";
            }

            $city = "";
            if (isset($data->sheets[$i]['cells'][$j][4])) {
                $str_array = explode('،', $data->sheets[$i]['cells'][$j][4]);
                $str_replace = str_replace('آدرس :', '', $str_array);
                $city = $str_replace[0];
                /*echo 'city:' . $city . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $city = "";
            }


            $address = "";
            if (isset($data->sheets[$i]['cells'][$j][4])) {
                $str_array = explode('،', $data->sheets[$i]['cells'][$j][4]);
                $replace = str_replace("$str_array[0]", '', $data->sheets[$i]['cells'][$j][4]);
                $address = $replace;
                /*echo 'address:' . $address . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $address = "";
            }


            $phone1 = "";
            $phone2 = "";
            $phone3 = "";
            $phone4 = "";
            $mobile1 = "";
            $mobile2 = "";
            $mobile3 = "";
            $email1 = "";
            $email2 = "";
            $fax = "";
            $postal_code = "";
            $web_site = "";
            $social_pages = "";
            $arr = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
            for ($k = 5; $k <= 11; $k++) {
                $tempData = $data->sheets[$i]['cells'][$j][$k];

                if (strpos($tempData, 'تلفن :') !== false) {
                    $replace = str_replace('تلفن :', '', $data->sheets[$i]['cells'][$j][$k]);
                    $str_len = strlen($replace);
                    if ($str_len <= 15) {
                        if ($str_len <= 12) {
                            $phone1 = substr($replace, 0);
                            $phone2 = $phone3 = $phone4 = "";
                        }
                        $phone1 = substr($replace, 0);

                        $phone2 = $phone3 = $phone4 = "";
                    }
                    switch ($str_len) {
                        case (29):
                            $phone1 = substr($replace, 0, 15);
                            $phone2 = substr($replace, 15, 14);
                            $phone3 = $phone4 = "";
                            break;
                        case (27):
                            $substr = substr($replace, 0, 15);
                            $strpos = strpos($substr, '~');
                            if ($strpos !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 12);
                                $phone3 = $phone4 = "";
                            } else {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 15);
                                $phone3 = $phone4 = "";
                            }
                            break;
                        case (25):
                            $phone1 = substr($replace, 0, 13);
                            $phone2 = substr($replace, 13, 12);
                            $phone3 = $phone4 = "";
                            break;
                        case (23):
                            $phone1 = substr($replace, 0, 12);
                            $phone2 = substr($replace, 12, 11);
                            $phone3 = $phone4 = "";
                            break;
                    }
                    switch ($str_len) {
                        case (43):
                            $phone1 = substr($replace, 0, 15);
                            $phone2 = substr($replace, 15, 14);
                            $phone3 = substr($replace, 29, 14);
                            $phone4 = "";
                            break;
                        case (41):
                            $substr1 = substr($replace, 0, 15);
                            $strpos1 = strpos($substr1, '~');
                            $substr2 = substr($replace, 15, 15);
                            $strpos2 = strpos($substr2, '~');
                            $substr3 = substr($replace, 30, 15);
                            $strpos3 = strpos($substr3, '~');
                            if ($strpos1 & $strpos2 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 14);
                                $phone3 = substr($replace, 29, 12);
                                $phone4 = "";
                            } elseif ($strpos1 & $strpos3 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 12);
                                $phone3 = substr($replace, 27, 14);
                                $phone4 = "";
                            } else {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 14);
                                $phone3 = substr($replace, 27, 14);
                                $phone4 = "";
                            }
                            break;
                        case (39):
                            $substr1 = substr($replace, 0, 15);
                            $strpos1 = strpos($substr1, '~');
                            $substr2 = substr($replace, 15, 15);
                            $strpos2 = strpos($substr2, '~');
                            $substr3 = substr($replace, 30, 15);
                            $strpos3 = strpos($substr3, '~');
                            if ($strpos1 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 12);
                                $phone3 = substr($replace, 27, 12);
                                $phone4 = "";
                            } elseif ($strpos2 !== false) {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 14);
                                $phone3 = substr($replace, 27, 12);
                                $phone4 = "";
                            } else {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 12);
                                $phone3 = substr($replace, 25, 14);
                                $phone4 = "";
                            }
                            break;
                        case (37):
                            $phone1 = substr($replace, 0, 13);
                            $phone2 = substr($replace, 13, 12);
                            $phone3 = substr($replace, 25, 12);
                            $phone4 = "";
                            break;
                    }

                    switch ($str_len) {
                        case (57):
                            $phone1 = substr($replace, 0, 15);
                            $phone2 = substr($replace, 15, 14);
                            $phone3 = substr($replace, 29, 14);
                            $phone4 = substr($replace, 43, 14);
                            break;
                        case (55):
                            $substr1 = substr($replace, 0, 15);
                            $strpos1 = strpos($substr1, '~');
                            $substr2 = substr($replace, 15, 15);
                            $strpos2 = strpos($substr2, '~');
                            $substr3 = substr($replace, 30, 15);
                            $strpos3 = strpos($substr3, '~');
                            $substr4 = substr($replace, 45, 15);
                            $strpos4 = strpos($substr4, '~');
                            if ($strpos1 & $strpos2 & $substr3 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 14);
                                $phone3 = substr($replace, 29, 14);
                                $phone4 = substr($replace, 43, 12);
                            } elseif ($strpos1 & $strpos2 & $substr4 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 14);
                                $phone3 = substr($replace, 29, 12);
                                $phone4 = substr($replace, 41, 14);
                            } elseif ($strpos1 & $strpos3 & $substr4 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 12);
                                $phone3 = substr($replace, 27, 14);
                                $phone4 = substr($replace, 41, 14);
                            } else {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 14);
                                $phone3 = substr($replace, 27, 14);
                                $phone4 = substr($replace, 41, 14);
                            }
                            break;
                        case (53):
                            $substr1 = substr($replace, 0, 15);
                            $strpos1 = strpos($substr1, '~');
                            $substr2 = substr($replace, 15, 15);
                            $strpos2 = strpos($substr2, '~');
                            $substr3 = substr($replace, 30, 15);
                            $strpos3 = strpos($substr3, '~');
                            $substr4 = substr($replace, 45, 15);
                            $strpos4 = strpos($substr4, '~');
                            if ($strpos1 & $strpos2 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 14);
                                $phone3 = substr($replace, 29, 12);
                                $phone4 = substr($replace, 41, 12);
                            } elseif ($strpos1 & $substr3 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 12);
                                $phone3 = substr($replace, 27, 14);
                                $phone4 = substr($replace, 41, 12);
                            } elseif ($strpos1 & $substr4 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 12);
                                $phone3 = substr($replace, 27, 12);
                                $phone4 = substr($replace, 39, 14);
                            } elseif ($strpos2 & $substr3 !== false) {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 14);
                                $phone3 = substr($replace, 27, 14);
                                $phone4 = substr($replace, 41, 12);
                            } else {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 14);
                                $phone3 = substr($replace, 27, 12);
                                $phone4 = substr($replace, 39, 14);
                            }
                            break;
                        case (51):
                            $substr1 = substr($replace, 0, 15);
                            $strpos1 = strpos($substr1, '~');
                            $substr2 = substr($replace, 15, 15);
                            $strpos2 = strpos($substr2, '~');
                            $substr3 = substr($replace, 30, 15);
                            $strpos3 = strpos($substr3, '~');
                            $substr4 = substr($replace, 45, 15);
                            $strpos4 = strpos($substr4, '~');
                            if ($strpos1 !== false) {
                                $phone1 = substr($replace, 0, 15);
                                $phone2 = substr($replace, 15, 12);
                                $phone3 = substr($replace, 27, 12);
                                $phone4 = substr($replace, 39, 12);
                            } elseif ($strpos2 !== false) {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 14);
                                $phone3 = substr($replace, 27, 12);
                                $phone4 = substr($replace, 39, 12);
                            } elseif ($strpos3 !== false) {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 12);
                                $phone3 = substr($replace, 25, 14);
                                $phone4 = substr($replace, 39, 12);
                            } else {
                                $phone1 = substr($replace, 0, 13);
                                $phone2 = substr($replace, 13, 12);
                                $phone3 = substr($replace, 25, 12);
                                $phone4 = substr($replace, 37, 14);
                            }
                            break;
                        case (49):
                            $phone1 = substr($replace, 0, 13);
                            $phone2 = substr($replace, 13, 12);
                            $phone3 = substr($replace, 25, 12);
                            $phone4 = substr($replace, 37, 12);
                            break;
                    }
                    /*echo 'phone1:' . $phone1 . '<br>' ;
                    echo 'phone2:' . $phone2 . '<br>' ;
                    echo 'phone3:' . $phone3 . '<br>' ;
                    echo 'phone4:' . $phone4 . '<br>' ;
                    echo '<br>' .'<br>', '<br>';*/
                    /* if (strlen($replace) > 40) {
                        $splitedPhone = explode("-", $replace);
                        $arrayPhones = array();
                        $hasPreCOde = 0;
                        for ($f = 0; $f < count($splitedPhone); $f++) {
                            if (strlen($splitedPhone[0]) < 5) {
                                $hasPreCOde = 1;
                            }
                            if ($hasPreCOde == 1) {
                                if ($f != 0)
                                    array_push($arrayPhones, $splitedPhone[0] . $splitedPhone[$f]);
                            }else{
                                array_push($arrayPhones, $splitedPhone[$f]);
                            }
                        }
                        echo "<pre>";
                        print_r($arrayPhones);
                        die;
                    }*/
                }

                if (strpos($tempData, 'تلفن همراه') !== false) {
                    $replace = str_replace('تلفن همراه :', '', $data->sheets[$i]['cells'][$j][$k]);
                    $str_len = strlen($replace);
                    if ($str_len <= 11) {
                        $mobile1 = substr($replace, 0, 12);
                    }
                    if ($str_len <= 22) {
                        $mobile1 = substr($replace, 0, 12);
                        $mobile2 = substr($replace, 12, 11);
                    }
                    if ($str_len <= 34) {
                        $mobile1 = substr($replace, 0, 12);
                        $mobile2 = substr($replace, 12, 11);
                        $mobile3 = substr($replace, 23, 11);
                    }
                    /*echo 'phone1:' . $mobile1 . '<br>' ;
                    echo 'phone2:' . $mobile2 . '<br>' ;
                    echo 'phone3:' . $mobile3 . '<br>' ;
                    echo '<br>' .'<br>', '<br>';*/
                }
                if (strpos($tempData, 'ایمیل') !== false) {
                    $replace = str_replace('ایمیل :', '', $data->sheets[$i]['cells'][$j][$k]);
                    $replace_com = str_replace('.com', '.com,', $replace);
                    $array = explode(',', $replace_com);
                    $email1 = $array[0];
                    $email2 = $array[1];
                    $email3 = $array[2];
                    /*echo 'email1:' . $email1 . '<br>' ;
                    echo 'email2:' . $email2 . '<br>' ;
                    echo '<br>' .'<br>', '<br>';*/
                }


                if (strpos($tempData, 'تلفکس') !== false) {
                    $replace = str_replace('تلفکس :', '', $data->sheets[$i]['cells'][$j][$k]);
                    $str_len = strlen($replace);
                    if ($str_len <= 15) {
                        if ($str_len <= 12) {
                            $fax1 = substr($replace, 0);
                            $fax2 = "";
                        }
                        $fax1 = substr($replace, 0);
                        $fax2 = "";
                    }
                    switch ($str_len) {
                        case (29):
                            $fax1 = substr($replace, 0, 15);
                            $fax2 = substr($replace, 15, 14);
                            break;
                        case (27):
                            $substr = substr($replace, 0, 15);
                            $strpos = strpos($substr, '~');
                            if ($strpos !== false) {
                                $fax1 = substr($replace, 0, 15);
                                $fax2 = substr($replace, 15, 12);
                            } else {
                                $fax1 = substr($replace, 0, 13);
                                $fax2 = substr($replace, 13, 15);
                            }
                            break;
                        case (25):
                            $fax1 = substr($replace, 0, 13);
                            $fax2 = substr($replace, 13, 12);
                            break;
                        case (23):
                            $fax1 = substr($replace, 0, 12);
                            $fax2 = substr($replace, 12, 11);
                            break;
                    }
                    /*echo 'fax1:' . $fax1 . '<br>' ;
                    echo 'fax2:' . $fax2 . '<br>' ;
                    echo '<br>' .'<br>', '<br>';*/
                }
                if (strpos($tempData, 'فکس') !== false) {
                    $fax = str_replace('فکس :', '', $data->sheets[$i]['cells'][$j][$k]);
                    $str_len = strlen($replace);
                    if ($str_len <= 15) {
                        if ($str_len <= 12) {
                            $fax1 = substr($replace, 0);
                            $fax2 = "";
                        }
                        $fax1 = substr($replace, 0);
                        $fax2 = "";
                    }
                    switch ($str_len) {
                        case (29):
                            $fax1 = substr($replace, 0, 15);
                            $fax2 = substr($replace, 15, 14);
                            break;
                        case (27):
                            $substr = substr($replace, 0, 15);
                            $strpos = strpos($substr, '~');
                            if ($strpos !== false) {
                                $fax1 = substr($replace, 0, 15);
                                $fax2 = substr($replace, 15, 12);
                            } else {
                                $fax1 = substr($replace, 0, 13);
                                $fax2 = substr($replace, 13, 15);
                            }
                            break;
                        case (25):
                            $fax1 = substr($replace, 0, 13);
                            $fax2 = substr($replace, 13, 12);
                            break;
                        case (23):
                            $fax1 = substr($replace, 0, 12);
                            $fax2 = substr($replace, 12, 11);
                            break;
                    }
                    /*echo 'fax1:' . $fax1 . '<br>' ;
                    echo 'fax2:' . $fax2 . '<br>' ;
                    echo '<br>' .'<br>', '<br>';*/
                }

                if (strpos($tempData, 'کد پستی') !== false) {
                    $postal_code = str_replace('کد پستی :', '', $data->sheets[$i]['cells'][$j][$k]);
                    /*echo "<pre>";
                    print_r($postal_code);*/
                }
                if (strpos($tempData, 'وب سایت') !== false) {
                    $web_site = str_replace('وب سایت :', '', $data->sheets[$i]['cells'][$j][$k]);
                }
                if (strpos($tempData, 'صفحات اجتماعی') !== false) {
                    $social_pages = str_replace('صفحات اجتماعی :', '', $data->sheets[$i]['cells'][$j][$k]);
                }
            }

            $title = "";
            if (isset($data->sheets[$i]['cells'][$j][12])) {
                $title = $data->sheets[$i]['cells'][$j][12];
            } else {
                $title = "";
            }

            $description = "";
            if (isset($data->sheets[$i]['cells'][$j][16])) {
                $description = $data->sheets[$i]['cells'][$j][16];
            } else {
                $description = "";
            }

            $labels = "";
            $categories = "";
            $tempData = $data->sheets[$i]['cells'][$j][17];
            if (isset($data->sheets[$i]['cells'][$j][17])) {
                $strreplace = str_replace('</li>', '</li>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[1]);
                $labels1 = strip_tags($array_unique[2]);
                $labels2 = strip_tags($array_unique[3]);
                $labels3 = strip_tags($array_unique[4]);
                $labels4 = strip_tags($array_unique[5]);
                $labels5 = strip_tags($array_unique[6]);
                /*echo 'categories:' . $categories . '<br>' ;
                echo 'labels1:' . $labels1 . '<br>' ;
                echo 'labels2:' . $labels2 . '<br>' ;
                echo 'labels3:' . $labels3 . '<br>' ;
                echo 'labels4:' . $labels4 . '<br>' ;
                echo 'labels5:' . $labels5 . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $labels = "";
            }


            $activity1 = "";
            $tempData = $data->sheets[$i]['cells'][$j][18];
            if (isset($data->sheets[$i]['cells'][$j][18])) {
                $strreplace = str_replace('</span>', '</span>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[0]);
                $activity11 = strip_tags($array_unique[1]);
                $activity12 = strip_tags($array_unique[2]);
                $activity13 = strip_tags($array_unique[3]);
                $activity14 = strip_tags($array_unique[4]);
                $activity15 = strip_tags($array_unique[5]);
                /*echo 'categories:' . $categories . '<br>' ;
                echo 'activity1:' . $activity11 . '<br>' ;
                echo 'activity2:' . $activity12 . '<br>' ;
                echo 'activity3:' . $activity13 . '<br>' ;
                echo 'activity4:' . $activity14 . '<br>' ;
                echo 'activity5:' . $activity15 . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $activity1 = "";
            }

            $activity2 = "";
            $tempData = $data->sheets[$i]['cells'][$j][19];
            if (isset($data->sheets[$i]['cells'][$j][19])) {
                $strreplace = str_replace('</span>', '</span>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[0]);
                $activity21 = strip_tags($array_unique[1]);
                $activity22 = strip_tags($array_unique[2]);
                $activity23 = strip_tags($array_unique[3]);
                $activity24 = strip_tags($array_unique[4]);
                $activity25 = strip_tags($array_unique[5]);
                /*     echo 'categories:' . $categories . '<br>' ;
                     echo 'activity1:' . $activity21 . '<br>' ;
                     echo 'activity2:' . $activity22 . '<br>' ;
                     echo 'activity3:' . $activity23 . '<br>' ;
                     echo 'activity4:' . $activity24 . '<br>' ;
                     echo 'activity5:' . $activity25 . '<br>' ;
                     echo '<br>' .'<br>', '<br>';*/
            } else {
                $activity2 = "";
            }

            $activity3 = "";
            $tempData = $data->sheets[$i]['cells'][$j][20];
            if (isset($data->sheets[$i]['cells'][$j][20])) {
                $strreplace = str_replace('</span>', '</span>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[0]);
                $activity31 = strip_tags($array_unique[1]);
                $activity32 = strip_tags($array_unique[2]);
                $activity33 = strip_tags($array_unique[3]);
                $activity34 = strip_tags($array_unique[4]);
                $activity35 = strip_tags($array_unique[5]);
                /* echo 'categories:' . $categories . '<br>';
                 echo 'activity1:' . $activity31 . '<br>' ;
                 echo 'activity2:' . $activity32 . '<br>' ;
                 echo 'activity3:' . $activity33 . '<br>' ;
                 echo 'activity4:' . $activity34 . '<br>' ;
                 echo 'activity5:' . $activity35 . '<br>' ;
            echo '<br>' .'<br>', '<br>';*/
            } else {
                $activity3 = "";
            }

            $activity4 = "";
            $tempData = $data->sheets[$i]['cells'][$j][21];
            if (isset($data->sheets[$i]['cells'][$j][21])) {
                $strreplace = str_replace('</span>', '</span>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[0]);
                $activity41 = strip_tags($array_unique[1]);
                $activity42 = strip_tags($array_unique[2]);
                $activity43 = strip_tags($array_unique[3]);
                $activity44 = strip_tags($array_unique[4]);
                $activity45 = strip_tags($array_unique[5]);
                /*echo 'categories:' . $categories . '<br>';
                echo 'activity1:' . $activity41 . '<br>' ;
                echo 'activity2:' . $activity42 . '<br>' ;
                echo 'activity3:' . $activity43 . '<br>' ;
                echo 'activity4:' . $activity44 . '<br>' ;
                echo 'activity5:' . $activity45 . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $activity4 = "";
            }

            $activity5 = "";
            $tempData = $data->sheets[$i]['cells'][$j][22];
            if (isset($data->sheets[$i]['cells'][$j][22])) {
                $strreplace = str_replace('</span>', '</span>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[0]);
                $activity51 = strip_tags($array_unique[1]);
                $activity52 = strip_tags($array_unique[2]);
                $activity53 = strip_tags($array_unique[3]);
                $activity54 = strip_tags($array_unique[4]);
                $activity55 = strip_tags($array_unique[5]);
                /*echo 'categories:' . $categories . '<br>';
                echo 'activity1:' . $activity51 . '<br>' ;
                echo 'activity2:' . $activity52 . '<br>' ;
                echo 'activity3:' . $activity53 . '<br>' ;
                echo 'activity4:' . $activity54 . '<br>' ;
                echo 'activity5:' . $activity55 . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $activity5 = "";
            }

            $activity6 = "";
            $tempData = $data->sheets[$i]['cells'][$j][23];
            if (isset($data->sheets[$i]['cells'][$j][23])) {
                $strreplace = str_replace('</span>', '</span>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[0]);
                $activity61 = strip_tags($array_unique[1]);
                $activity62 = strip_tags($array_unique[2]);
                $activity63 = strip_tags($array_unique[3]);
                $activity64 = strip_tags($array_unique[4]);
                $activity65 = strip_tags($array_unique[5]);
                /*echo 'categories:' . $categories . '<br>';
                echo 'activity1:' . $activity61 . '<br>' ;
                echo 'activity2:' . $activity62 . '<br>' ;
                echo 'activity3:' . $activity63 . '<br>' ;
                echo 'activity4:' . $activity64 . '<br>' ;
                echo 'activity5:' . $activity65 . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $activity6 = "";
            }

            $activity7 = "";
            $tempData = $data->sheets[$i]['cells'][$j][24];
            if (isset($data->sheets[$i]['cells'][$j][24])) {
                $strreplace = str_replace('</span>', '</span>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[0]);
                $activity71 = strip_tags($array_unique[1]);
                $activity72 = strip_tags($array_unique[2]);
                $activity73 = strip_tags($array_unique[3]);
                $activity74 = strip_tags($array_unique[4]);
                $activity75 = strip_tags($array_unique[5]);
                /*echo 'categories:' . $categories . '<br>';
                echo 'activity1:' . $activity71 . '<br>' ;
                echo 'activity2:' . $activity72 . '<br>' ;
                echo 'activity3:' . $activity73 . '<br>' ;
                echo 'activity4:' . $activity74 . '<br>' ;
                echo 'activity5:' . $activity75 . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $activity7 = "";
            }

            $activity8 = "";
            $tempData = $data->sheets[$i]['cells'][$j][25];
            if (isset($data->sheets[$i]['cells'][$j][25])) {
                $strreplace = str_replace('</span>', '</span>,', $tempData);
                $array = explode(',', $strreplace);
                $array_unique = array_unique($array);
                $categories = strip_tags($array_unique[0]);
                $activity81 = strip_tags($array_unique[1]);
                $activity82 = strip_tags($array_unique[2]);
                $activity83 = strip_tags($array_unique[3]);
                $activity84 = strip_tags($array_unique[4]);
                $activity85 = strip_tags($array_unique[5]);
                /*echo 'categories:' . $categories . '<br>';
                echo 'activity1:' . $activity81 . '<br>' ;
                echo 'activity2:' . $activity82 . '<br>' ;
                echo 'activity3:' . $activity83 . '<br>' ;
                echo 'activity4:' . $activity84 . '<br>' ;
                echo 'activity5:' . $activity85 . '<br>' ;
                echo '<br>' .'<br>', '<br>';*/
            } else {
                $activity8 = "";
            }

            $query = mysqli_set_charset($conn, 'utf8');
            $query = "insert into main
                        (web_address,status_code,status,web_site,social_pages,title,description)
                         values
                         ('" . $web_address . "','" . $status_code . "','" . $status . "','" . $web_site . "','" . $social_pages . "','" . $title . "','" . $description . "')";
            mysqli_query($conn, $query);
            $select_id = $conn->insert_id;

            $query_address = "insert into address
                        (city ,address,postal_code ,main_id)
                         values
                         ('" . $city . "','" . $address . "','" . $postal_code . "','" . $select_id . "')";
            mysqli_query($conn, $query_address);


            $query_phone = "insert into phone
                        (phone1,phone2,phone3,phone4,main_id)
                         values
                         ('" . $phone1 . "','" . $phone2 . "','" . $phone3 . "' ,'" . $phone4 . "','" . $select_id . "')";
            mysqli_query($conn, $query_phone);


            $query_mobile = "insert into mobile
                        (mobile1,mobile2,mobile3,main_id)
                         values
                         ('" . $mobile1 . "','" . $mobile2 . "','" . $mobile3 . "','" . $select_id . "')";
            mysqli_query($conn, $query_mobile);


            $query_email = "insert into email
                        (email1,email2,email3,main_id)
                         values
                         ('" . $email1 . "','" . $email2 . "','" . $email3 . "','" . $select_id . "')";
            mysqli_query($conn, $query_email);

            $query_fax = "insert into fax
                        (fax1,fax2,main_id)
                         values
                         ('" . $fax1 . "','" . $fax2 . "','" . $select_id . "')";
            mysqli_query($conn, $query_fax);

            $query_labels = "insert into labels
                            (categories,labels1,labels2,labels3,labels4,labels5,main_id)
                         values
                         ('" . $categories . "','" . $labels1 . "','" . $labels2 . "' ,'" . $labels3 . "' ,'" . $labels4 . "' ,'" . $labels5 . "','" . $select_id . "')";
            mysqli_query($conn, $query_labels);

            $query_activity1 = "insert into activity1
                            (categories ,activity1 ,activity2,activity3,activity4 ,activity5,main_id)
                         values
                         ('" . $categories . "','" . $activity11 . "','" . $activity12 . "' ,'" . $activity13 . "' ,'" . $activity14 . "' ,'" . $activity15 . "','" . $select_id . "')";
            mysqli_query($conn, $query_activity1);

            $query_activity2 = "insert into activity2
                            (categories,activity1,activity2,activity3,activity4,activity5,main_id)
                         values
                         ('" . $categories . "','" . $activity21 . "','" . $activity22 . "','" . $activity23 . "','" . $activity24 . "','" . $activity25 . "','" . $select_id . "')";
            mysqli_query($conn, $query_activity2);

            $query_activity3 = "insert into activity3
                            (categories,activity1,activity2,activity3,activity4,activity5,main_id)
                         values
                         ('" . $categories . "','" . $activity31 . "','" . $activity32 . "','" . $activity33 . "','" . $activity34 . "','" . $activity35 . "','" . $select_id . "')";
            mysqli_query($conn, $query_activity3);

            $query_activity4 = "insert into activity4
                            (categories,activity1,activity2,activity3,activity4,activity5,main_id)
                         values
                         ('" . $categories . "','" . $activity41 . "','" . $activity42 . "','" . $activity43 . "','" . $activity44 . "','" . $activity45 . "','" . $select_id . "')";
            mysqli_query($conn, $query_activity4);

            $query_activity5 = "insert into activity5
                            (categories,activity1,activity2,activity3,activity4,activity5,main_id)
                         values
                         ('" . $categories . "','" . $activity51 . "','" . $activity52 . "','" . $activity53 . "','" . $activity54 . "','" . $activity55 . "','" . $select_id . "')";
            mysqli_query($conn, $query_activity5);

            $query_activity6 = "insert into activity6
                            (categories,activity1,activity2,activity3,activity4,activity5,main_id)
                         values
                         ('" . $categories . "','" . $activity61 . "','" . $activity62 . "','" . $activity63 . "','" . $activity64 . "','" . $activity65 . "','" . $select_id . "')";
            mysqli_query($conn, $query_activity6);

            $query_activity7 = "insert into activity7
                            (categories,activity1,activity2,activity3,activity4,activity5,main_id)
                         values
                         ('" . $categories . "','" . $activity71 . "','" . $activity72 . "','" . $activity73 . "','" . $activity74 . "','" . $activity75 . "','" . $select_id . "')";
            mysqli_query($conn, $query_activity7);

            $query_activity8 = "insert into activity8
                            (categories,activity1,activity2,activity3,activity4,activity5,main_id)
                         values
                         ('" . $categories . "','" . $activity81 . "','" . $activity82 . "','" . $activity83 . "','" . $activity84 . "','" . $activity85 . "','" . $select_id . "')";
            mysqli_query($conn, $query_activity8);

        }
    }
}
echo "COMPLATE";

/*$result = mysqli_query($conn, "SELECT * FROM main") or die(mysqli_error($conn));

while ($row = mysqli_fetch_array($result)) {
    echo "<pre>";
    print_r($row['labels']);
}*/

/*$add_foreign_address = "ALTER TABLE address
            ADD FOREIGN KEY (mainid) REFERENCES main(mainid)";
            mysqli_query($conn, $add_foreign_address);
            mysqli_query($conn, $query_address);*/


