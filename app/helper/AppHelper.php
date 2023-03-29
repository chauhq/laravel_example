<?php

namespace App\Helper;
class AppHelper {

    static function removeNullValues(array $data)
    {
        $filtered_data = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                if (sizeof($value) > 0)
                    $filtered_data[$key] = AppHelper :: removeNullValues($value);
            } else if ($value != null) {
                $filtered_data[$key] = $value;
            }
        }

        return $filtered_data;
    }

}
