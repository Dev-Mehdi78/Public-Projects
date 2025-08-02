<?php

function GetTypeFields ($FieldName , $AccessField){
    //echo '<pre>';
    foreach ($AccessField as $Field){
        $Field = (array)$Field;
        if ($Field['name'] === $FieldName){
            $Result = $Field;
        }
    }
    return $Result;
}

function GetTypeSymbolCurrency ($AccessField){
    //echo '<pre>';
    foreach ($AccessField as $Field){
        $Field = (array)$Field;
        if ($Field['type']->name === 'currency'){
            $Result = $Field['type']->symbol;
        }
    }
    return $Result;
}


/*function GetNameUsersList ($AccessField , $UITypeFields){
    //echo '<pre>';
    foreach ($AccessField as $Field){
        $Field = (array)$Field;
        if ($Field['type']->name == $UITypeFields){
            //return 'fffffffffffff';
            if (isset($Field['parsvtfield']) && $Field['parsvtfield']->name == 'Users List' && $Field['uitype'] == 780){
                $Result = 'Yes';
            }else{
                $Result = 'NoUser';
            }
        }
    }
    return $Result;
}*/