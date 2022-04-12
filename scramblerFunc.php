<?php

function displayKey($key){
    printf("value = %s", $key);
}

function scrambleData($originalData, $key){
    $original_key = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $data = '';//taking an empty strig to keep the scrambled data later
    $length = strlen($originalData);//finding length of given string
    for ($i = 0; $i < $length; $i++){
        $currentChar = $originalData[$i];
        $position = strpos($original_key, $currentChar);//finding the position of the character in the original key so that we can understand ex. d = h, k = l etc
        if ($position !== false){//reason using this === is this will check the type as well. Cause strpos will return 0/1, which can conflict with the real position
            $data .= $key[$position];//Here, .= is concatenating the string and $key[$position] is putting the real key value of that position
        }
        else{
            $data = $currentChar;//since we have given all small chars in key, capital chars will not be counted
        }
    }
    return $data;
}

function decodeData($originalData, $key){
    $original_key = 'abcdefghijklmnopqrstuvwxyz1234567890';
    $data = '';
    $length = strlen($originalData);
    for ($i = 0; $i < $length; $i++){
        $currentChar = $originalData[$i];
        $position = strpos($key, $currentChar);//finding the position of the character in the given key so that we can understand ex. d = h, k = l etc
        if ($position !== false){
            $data .= $original_key[$position];//Here, .= is concatenating the string and $original_key[$position] is putting the real key value of that position
        }
        else{
            $data = $currentChar;//since we have given all small chars in key, capital chars will not be counted as well as other ascii chars
        }
    }
    return $data;
}
