<?php

namespace App\Http\Service;

use Illuminate\Support\Arr;

class HandleArrayService
{
    public function handleArray($array)
    {
        $string = Arr::get($array,'text');
        return $this->numberRoman($string);
    }

    private function numberRoman($string)
    {
        $auxFound = '';
        $auxAdder     = 0;
        $arrayResult    = [];

        $array  = [
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000,
        ];

        for ($i = 0; $i < strlen($string); $i++) {
            if (key_exists($string[$i],$array)) {
                $auxAdder = $array[$string[$i]];
                $auxFound = $string[$i];

                for ($j = $i + 1; $j < strlen($string); $j++) {
                    if (isset($string[$j]) && key_exists($string[$j],$array)) {
                        $auxAdder += $array[$string[$j]];
                        $auxFound .= $string[$j];
                    }else
                        break;
                }
            }
            if ($auxAdder != 0) {
                $arrayResult[] = [
                    'number' => $auxFound,
                    'value' => $auxAdder
                ];
            }
            $auxAdder = 0;
            $auxFound = '';
        }

        return $this->greatestRoman($arrayResult);
    }

    private function greatestRoman($arrayResult)
    {
        $array = [];
        $totalAdder = 0;

        foreach ($arrayResult as $result) {
            $resultExpress = preg_match("(^(?=[MDCLXVI])M*(C[MD]|D?C{0,3})(X[CL]|L?X{0,3})(I[XV]|V?I{0,3})$)",$result['number']);
            if ($result['value'] > $totalAdder && $resultExpress) {
                $totalAdder = $result['value'];
                $array = $result;
            }
        }

        return $array;
    }

}
