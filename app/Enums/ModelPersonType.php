<?php

namespace App\Enums;

use \App\Traits\Enum;

class ModelPersonType extends Enum
{
    public const PF = "F";
    public const PJ = "J";

    public static function listAll(){
        return [
            self::PF,
            self::PJ,
        ];
    }

    public static function listAllDesc(){
        return [
            self::PF => "Empresa",
            self::PJ => "Fornecedor",
        ];
    }

    public static function getClientType($clientType){
        $arrTypes =  [
            self::PF => "Empresa",
            self::PJ => "Fornecedor",
        ];
        return isset($arrTypes[$clientType]) ?? null;
    }
}
