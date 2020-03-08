<div class="p-topbar"><h3>[練習2.4]</h3><h2>含兩個複母音拼詞</h2></div>
<div style="width: 100%; height: calc(100% - 64px);">
    <div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center;">
        <div style="min-height: 100px;">
<?php
$json = 
'[
    {"word":"diaukvia","sound":""},
    {"word":"hoanbun","hint":"煩悶","sound":""},
    {"word":"hoeviu","sound":""},
    {"word":"iutai","sound":""},
    {"word":"kauvoa","sound":""},
    {"word":"kiaugvo","hint":"驕傲","sound":""},
    {"word":"kuioe","sound":""},
    {"word":"lau\'oe","sound":""},
    {"word":"paigoa","sound":""},
    {"word":"poephvoa","hint":"陪伴","sound":""},
    {"word":"soalau","hint":"沙漏","sound":""},
    {"word":"suizai","sound":""},
    {"word":"toamia","hint":"#忍病工作","sound":""},
    {"word":"uipoe","sound":""},
    {"word":"viadui","hint":"營隊","sound":""},
    {"word":"viudau","hint":"洋豆","sound":""},
    {"word":"zaihai","sound":""},
    {"word":"zailiau","sound":""}
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
        <div class="smallbtn" onclick="RequestPractice('2.4.php?num=<?php echo "".($randomIndex-1); ?>');">上一個</div>
        <div class="smallbtn" onclick="RequestPractice('2.4.php');">隨機</div>
        <div class="smallbtn" onclick="RequestPractice('2.4.php?num=<?php echo "".($randomIndex+1); ?>');">下一個</div>
    </div>
</div>