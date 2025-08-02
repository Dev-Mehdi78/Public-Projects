<?php

class Language {

    public function Translate($Param , $Variable = null){
        $LanguageType = $_SESSION['Type_Language'];
        require ("languages/".$LanguageType."/".$LanguageType.".php");

        if ($Variable != null){
            $TranslateParam = str_replace('$Variable$' , $Variable , $languageStrings[$Param] );
            return $TranslateParam;
        }

        $TranslateParam = $languageStrings[$Param];
        return $TranslateParam;
    }

}