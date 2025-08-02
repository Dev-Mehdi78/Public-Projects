<?php

class changePassword_model extends Model
{
    public function Process_ChangePassword (){
        if (isset($_POST['Data_Change_Password'])) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $OldPassword    = $_REQUEST['CurrentPassword'];
                $NewPassword    = $_REQUEST['NewPassword'];
                $RepNewPassword = $_REQUEST['RepetitionNewPassword'];
                if ($OldPassword == $_SESSION['password']){
                    if ($NewPassword === $RepNewPassword){
                        $Process = parent::WS_ChangePassword($OldPassword , $NewPassword);
                        if ($Process['success'] === true){
                            $Result = 'ChangePasswordSuccess';
                        }
                    }else{
                        $Result = 'Password Mismatch';
                    }
                }else{
                    $Result = 'Incorrect OldPassword';
                }
                return $Result;
            }
        }
    }
}