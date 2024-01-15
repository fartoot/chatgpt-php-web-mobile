<?php

    function lastest_file_in_dir($dir,$extension){
        $files = array_diff(scandir($dir), array(".", ".."));
        $last = 0;
        foreach ($files as $key => $value) {
            $curent_value = intval(trim($value,$extension));
            if ($curent_value > $last){
                $last = $curent_value;
            }
        }
        return $last;
    }