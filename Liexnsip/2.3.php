<div class="p-topbar"><h3>[練習2.3]</h3><h2>含複母音及單母音拼詞</h2></div>
<div style="width: 100%; height: calc(100% - 64px);">
    <div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center;">
        <div style="min-height: 100px;">
<?php
$json = 
'[
    {"word":"boviu","sound":""},
    {"word":"chialo","sound":""},
    {"word":"dionggi","sound":""},
    {"word":"dngmia","sound":""},
    {"word":"ioichi","hint":"育飼","sound":""},
    {"word":"iu\'u","hint":"猶豫","sound":""},
    {"word":"kihoe","sound":""},
    {"word":"kvialo","sound":""},
    {"word":"miahoi","sound":""},
    {"word":"moapng","hint":"鰻飯","sound":""},
    {"word":"nimai","hint":"年邁","sound":""},
    {"word":"qaibo","sound":""},
    {"word":"quichi","sound":""},
    {"word":"quilo","sound":""},
    {"word":"saihu","sound":""},
    {"word":"siaulo","hint":"銷路","sound":""},
    {"word":"sidai","sound":""},
    {"word":"sviachi","sound":""},
    {"word":"svoalo","hint":"山路","sound":""},
    {"word":"taulo","hint":"頭路","sound":""},
    {"word":"zai\'ge","sound":""},
    {"word":"zhakui","sound":""},
    {"word":"zngsia","sound":""}
]'
;
$words = json_decode($json);
$randomIndex = rand ( 0, count($words)-1);
if(isset($_GET["num"]) && is_numeric($_GET["num"]))
{
    $randomIndex = $_GET["num"];
    if($randomIndex >= count($words)) $randomIndex = 0;
    if($randomIndex < 0) $randomIndex = count($words)-1;
}

echo "<h1>".$words[$randomIndex]->{'word'}."</h1>";
if(isset($words[$randomIndex]->{'hint'}))
{
    echo "<h3>".$words[$randomIndex]->{'hint'}."</h3>";
}
?>
</div>
        <div class="smallbtn" onclick="RequestPractice('2.3.php?num=<?php echo "".($randomIndex-1); ?>');">上一個</div>
        <div class="smallbtn" onclick="RequestPractice('2.3.php');">隨機</div>
        <div class="smallbtn" onclick="RequestPractice('2.3.php?num=<?php echo "".($randomIndex+1); ?>');">下一個</div>
    </div>
</div>