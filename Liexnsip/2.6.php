<div class="p-topbar"><h3>[練習2.6]</h3><h2>含兩個後鼻音拼詞</h2></div>
<div style="width: 100%; height: calc(100% - 64px);">
    <div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center;">
        <div style="min-height: 100px;">
<?php
$json = 
'[
    {"word":"damjim","sound":""},
    {"word":"damlun","sound":""},
    {"word":"dangbin","hint":"東面","sound":""},
    {"word":"engheng","sound":""},
    {"word":"zengbang","sound":""},
    {"word":"zhengzeng","sound":""},
    {"word":"giampan","sound":""},
    {"word":"kenggiam","sound":""},
    {"word":"kiamjim","sound":""},
    {"word":"kiongpien","hint":"強辯","sound":""},
    {"word":"koankien","hint":"關鍵","sound":""},
    {"word":"koanliam","sound":""},
    {"word":"qinqiam","sound":""},
    {"word":"lienjim","sound":""},
    {"word":"lun\'ham ","hint":"淪陷","sound":""},
    {"word":"sunzeng","hint":"純淨","sound":""},
    {"word":"zenggoan","sound":""}
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
        <div class="smallbtn" onclick="RequestPractice('2.6.php?num=<?php echo "".($randomIndex-1); ?>');">上一個</div>
        <div class="smallbtn" onclick="RequestPractice('2.6.php');">隨機</div>
        <div class="smallbtn" onclick="RequestPractice('2.6.php?num=<?php echo "".($randomIndex+1); ?>');">下一個</div>
    </div>
</div>