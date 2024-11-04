<?php

namespace Phox\Phigma\Models;

class Helper
{
    public static function snakeCaseArrayKeys(array $inputArray)
    {
        $outputArray = [];

        if (array_is_list($inputArray)) {
            foreach ($inputArray as $index => $value) {
                if (is_array($value)) {
                    $value = self::snakeCaseArrayKeys($value);
                }

                $outputArray[$index] = $value;
            }

            return $outputArray;
        }

        foreach ($inputArray as $key => $value) {
            if (is_array($value)) {
                $value = self::snakeCaseArrayKeys($value);
            }

            $key = strtolower(trim(preg_replace('/([A-Z])/', '_$1', $key)));
            $outputArray[$key] = $value;
        }

        return $outputArray;
    }
}