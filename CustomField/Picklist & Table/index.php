<?php
ini_set("display_errors", 1);
ini_set('error_reporting', E_ERROR);
function crm_query_method($query){
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "http://192.168.100.97/Mehdi/modules/ParsVT/ws/API/V2/vtiger/default/query?query=$query",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXRDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTEOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Authorization: Basic YWRtaW46MTIzNDU2Nzg5'
        ),
    ));

    $response = curl_exec($curl);
    curl_close($curl);
    return json_decode($response, true);
}
function cleaned_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if (isset($_POST['SubmitButton'])) {

    $selected_search = cleaned_input($_POST['selected_search']);
    $title_search = cleaned_input($_POST['title_search']);

    if ($title_search != null) {

        if ($selected_search == 0) {
            $json = crm_query_method("select%20*%20from%20Invoice;");
            //echo "ok";
        }

        elseif ($selected_search == 1) {
            echo 'test';
        }

        elseif ($selected_search == 2) {
            echo 'test';
        }

        elseif ($selected_search == 3) {
            echo 'test';
        }

        elseif ($selected_search == 4) {
            echo 'test';
        }

        elseif ($selected_search == 5) {
            echo 'test';
        }

        elseif ($selected_search == 6) {
            echo 'test';
        }

        elseif ($selected_search == 7) {
            echo 'test';
        }
    }
}
?>
    <html lang="en" dir="rtl">
    <head>
        <meta charset="UTF-8">

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="bootstrap/Font/fonts.css">
        <style>
            body {
                font-family: BYekan;
            }

            .navigation_top {
                color: #7a7a7f;
                text-align: right;
                background-color: #fff;
                font-weight: normal;
                font-size: 16px;
                line-height: 1.8;
                height: auto;
                box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .5);
                width: 90%;
                padding: 3% 3% 3% 2%;
                margin: 5% 5%;
            }

            .grid-container_top {
                display: grid;
                grid-template-columns: 50% 30% 20%;
            }

            .grid-container {
                display: grid;
                grid-template-columns: 50% 50%;
            }
        </style>
    </head>
    <body>

    <div class="navigation_top">
        <form action="" method="post">
            <div class="grid-container_top">
                <div>
                    <div class="form-group has-success">
                        <label style="margin-right: 20%" class="control-label" for="inputSuccess1">جستوجو براساس</label>
                        <select name="selected_search" style="width: 50% ; margin-right: 20%" class="form-control" id="selected_search">
                            <option value="0">یک گزینه انتخاب کنید</option>
                            <option value="1">شماره ضمانت نامه</option>
                            <option value="2">شماره سریال کندانسور</option>
                            <option value="3">شماره سریال اپراتور</option>
                            <option value="4">شماره حواله</option>
                            <option value="5">شماره فاکتور</option>
                            <option value="6">نام صاحب کالا</option>
                            <option value="7">تاریخ نصب</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div class="form-group has-success">
                        <label style="margin-right: 32%" class="control-label" for="inputSuccess1">عنوان جستوجو</label>
                        <input style="width: 80% ; margin-right: 32%" type="text" class="form-control"
                               id="title_search" name="title_search">
                    </div>
                </div>
                <div>
                    <input style="margin: 13% 20% auto auto " type="submit" class="btn btn-success" value="جستوجو"
                           name="SubmitButton" id="SubmitButton">
                </div>
            </div>
        </form>
        <br>
        <div class="panel-heading">
            <div class="grid-container">
                <div class="grid-item_top_nav text_center">
                    <div class="form-group has-success" style="margin-right: 25%">
                        <label class="control-label" for="inputSuccess1">نام صاحب کالا: </label>
                        <input style="width: 60%" type="text" class="form-control" id="inputSuccess1"
                               aria-describedby="helpBlock2">
                    </div>
                </div>
                <div class="grid-item_top_nav text_center">
                    <div class="form-group has-success" style="margin-right: 20%">
                        <label style="" class="control-label" for="inputSuccess1">کد ملی / شناسه ملی: </label>
                        <input style="width: 55%" type="text" class="form-control" id="inputSuccess1"
                               aria-describedby="helpBlock2">
                    </div>
                </div>
            </div>
        </div>
        <b>
            <pre class="text-center">دستگاه های خریداری شده</pre>
        </b>


        <table class="table table-striped" style="width: 80%; text-align: center; margin-right: 10%">
            <thead>
            <tr>
                <th scope="col">ردیف</th>
                <th scope="col">مدل کالا</th>
                <th scope="col">سریال های کالا</th>
                <th scope="col">شماره ضمانت نامه</th>
                <th scope="col">تاریخ نصب</th>
                <th scope="col">محل نصب</th>

            </tr>
            </thead>
            <tbody>

<?php
//echo "<pre>";print_r($json['result']);
            $count = count($json['result']);
            echo $count;
            if ($count > 0){
                for ($x = 0 ; $x < $count ; $x++){
                    $row = $x + 1 ;
                    echo ('
                                <tr>
                                    <th scope="row">'.$row.'</th>
                                    <td>'.$json['result'][$x]['subject'].'</td>
                                    <td>'.$json['result'][$x]['assigned_user_id'].'</td>
                                    <td>'.$json['result'][$x]['productid'].'</td>
                                    <td>'.$json['result'][$x]['invoice_no'].'</td>
                                    <td>'.$json['result'][$x]['currency_id'].'</td>
                                </tr>
                            ');
                    //echo "<pre>";print_r($json['result'][1]);
                }
            }
            ?>
            </tbody>
        </table>
    </div>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    </body>
    </html>


<?php


