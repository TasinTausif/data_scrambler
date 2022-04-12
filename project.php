<?php
include_once "scramblerFunc.php";

$task = $_GET['task'] ?? 'encode';//Checking if the value of get variable is set, means the key is set or not

$key = 'abcdefghijklmnopqrstuvwxyz1234567890';
if ('key' == $task){
    $key = str_shuffle($key);//str_shuffle will shuffle the elements
//    $key_original = str_split($key);//this function will split every chars of the string since it has no delimeters
//    shuffle($key_original);
//    $key = join('', $key_original);//after shuffling every element, joining the array and making a string again
}elseif (isset($_POST['key']) && $_POST['key'] != ''){//checking if the key value is set, if set, retaining the value
    $key = $_POST['key'];
}

$scrambledData = '';
if ('encode' == $task){
    $data = $_POST['data'] ?? '';//getting values from data from form
    if ($data != ''){
        $scrambledData = scrambleData($data, $key);
    }
}

if ('decode' == $task){
    $data = $_POST['data'] ?? '';
    if ($data != ''){
        $scrambledData = decodeData($data, $key);
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Scrambler</title>
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Roboto+Slab">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
    <style>
        body{
            margin-top: 30px;
        }
        #data{
            width: 100%;
            height: 160px;
        }
        #result{
            width: 100%;
            height: 160px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="column column-60 column-offset-20">
            <h2>Data Scrambler</h2>
            <p>This project will scramble data</p>
            <p>
                <!--Here Get Variable is used. First, destination file name, then ?, then variable name, then value. And to use this variable we use, $_GET['variableName']-->
                <a href="project.php?task=encode">Encode</a> |
                <a href="project.php?task=decode">Decode</a> |
                <a href="project.php?task=key">Generate Key</a>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="column column-60 column-offset-20">
            <form method="POST" action="project.php<?php if ('decode' == $task){echo "?task=decode";} else{echo "?task=encode";}?>">
                <label for="key">Key</label>
                <input type="text" name="key" id="key" <?php displayKey($key); ?>>
                <label for="data">Data</label>
                <textarea name="data" id="data"><?php if (isset($_POST['data'])){echo $_POST['data'];}?></textarea>
                <label for="result">Result</label>
                <textarea id="result"><?php echo $scrambledData;?></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>