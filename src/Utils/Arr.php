<?php

namespace Phox\Phigma\Utils;

class Arr
{
    public static function snakeCaseKeys(array $inputArray): array
    {
        $outputArray = [];

        if (array_is_list($inputArray)) {
            foreach ($inputArray as $index => $value) {
                if (is_array($value)) {
                    $value = self::snakeCaseKeys($value);
                }

                $outputArray[$index] = $value;
            }

            return $outputArray;
        }

        foreach ($inputArray as $key => $value) {
            if (is_array($value)) {
                $value = self::snakeCaseKeys($value);
            }

            /**
             * @var string $key
             */
            $key = preg_replace('/([A-Z])/', '_$1', $key);
            $key = strtolower(trim($key));
            $outputArray[$key] = $value;
        }

        return $outputArray;
    }
}