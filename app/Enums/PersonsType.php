<?php

namespace App\Enums;

use \App\Traits\Enum;

class PersonsType extends Enum
{
    public const PROVIDERS = "PROVIDERS";
    public const COMPANIES = "COMPANIES";

    public static function listAll(){
        return [
            self::COMPANIES,
            self::PROVIDERS,
        ];
    }

    public static function listAllDesc(){
        return [
            self::COMPANIES => "Empresa",
            self::PROVIDERS => "Fornecedor",
        ];
    }

    public static function getClientType($clientType){
        $arrTypes =  [
            self::COMPANIES => "Empresa",
            self::PROVIDERS => "Fornecedor",
        ];
        return isset($arrTypes[$clientType]) ?? null;
    }
}
