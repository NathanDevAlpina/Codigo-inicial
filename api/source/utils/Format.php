<?php

namespace Source\Utils;

class Format
{
    public static function parameterRoute(string $parameter): string
    {
        $formattedClass = mb_strtoupper($parameter[0]);
        
        for ($i = 1; $i < mb_strlen($parameter); $i++) {
            if ($parameter[$i] === "-") {
                $i++;
                
                $formattedClass .= mb_strtoupper($parameter[$i]);
            } else {
                $formattedClass .= mb_strtolower($parameter[$i]);
            }
        }
        
        return $formattedClass;
    }
    
    public static function sql(string $sql): string
    {
        $formattedSQL = preg_replace("/\s+/", " ", trim($sql));

        if (!preg_match("/^.*;$/", $formattedSQL)) {
            $formattedSQL .= ";";
        }

        return $formattedSQL;
    }
}