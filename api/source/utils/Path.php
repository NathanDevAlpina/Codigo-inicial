<?php

namespace Source\Utils;

abstract class Path
{
    public static function resolve(array $pathArray): string
    {
        return implode(DIRECTORY_SEPARATOR, $pathArray);
    }
}