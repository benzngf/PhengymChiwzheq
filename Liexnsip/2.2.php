<div class="p-topbar"><h3>[練習2.2]</h3><h2>含前鼻音 V 拼詞</h2></div>
<div style="width: 100%; height: calc(100% - 64px);">
    <div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center; width: 100%;">
        <div style="min-height: 100px;">
<?php
$json = 
'[
    {"word":"chvihun","hint":"陌生","sound":""},
    {"word":"dve","sound":""},
    {"word":"dvi","sound":""},
    {"word":"gve","sound":""},
    {"word":"gvi","sound":""},
    {"word":"hva","hint":"跨","sound":""},
    {"word":"hvi","sound":""},
    {"word":"i\'vi","hint":"醫院","sound":""},
    {"word":"pve","sound":""},
    {"word":"pvi","sound":""},
    {"word":"svi","sound":""},
    {"word":"svilo","sound":""},
    {"word":"tvide","sound":""},
    {"word":"va","sound":""},
    {"word":"vi","sound":""},
    {"word":"zhamgi-vi","hint":"參議院","sound":""},
    {"word":"zhogvi","hint":"粗硬","sound":""}
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
        <div class="smallbtn" onclick="RequestPractice('2.2.php?num=<?php echo "".($randomIndex-1); ?>');">上一個</div>
        <div class="smallbtn" onclick="RequestPractice('2.2.php?rand=<?php echo "".microtime(true); ?>');">隨機</div>
        <div class="smallbtn" onclick="RequestPractice('2.2.php?num=<?php echo "".($randomIndex+1); ?>');">下一個</div>
    </div>
</div>