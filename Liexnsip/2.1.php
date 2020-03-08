<div class="p-topbar"><h3>[練習2.1]</h3><h2>基調音含單母音拼詞</h2></div>
<div style="width: 100%; height: calc(100% - 64px);">
    <div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center; width: 100%;">
        <div style="min-height: 100px;">
<?php
$json = 
'[
    {"word":"bosu","hint":"謀事","sound":""},
    {"word":"cipo","sound":""},
    {"word":"ci\'ha","sound":""},
    {"word":"dido","sound":""},
    {"word":"doilo","sound":""},
    {"word":"gudo","sound":""},
    {"word":"hichi","sound":""},
    {"word":"huhu","hint":"夫婦","sound":""},
    {"word":"judoi","sound":""},
    {"word":"jisi","hint":"而是","sound":""},
    {"word":"jusi","hint":"如是","sound":""},
    {"word":"kaqu","sound":""},
    {"word":"kechi","sound":""},
    {"word":"kelo","sound":""},
    {"word":"ke\'nng","sound":""},
    {"word":"kohu","sound":""},
    {"word":"koido","sound":""},
    {"word":"lole","sound":""},
    {"word":"mngchi","sound":""},
    {"word":"mngho","sound":""},
    {"word":"mohe","sound":""},
    {"word":"moli","sound":""},
    {"word":"nido","sound":""},
    {"word":"o\'doi","sound":""},
    {"word":"qalo","hint":"腳路","sound":""},
    {"word":"sisu","sound":""},
    {"word":"su\'de","sound":""},
    {"word":"suhu","sound":""},
    {"word":"tesi","sound":""},
    {"word":"usi","hint":"於是","sound":""},
    {"word":"zha\'i","sound":""},
    {"word":"zhopo","sound":""}
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
        <div class="smallbtn" onclick="RequestPractice('2.1.php?num=<?php echo "".($randomIndex-1); ?>');">上一個</div>
        <div class="smallbtn" onclick="RequestPractice('2.1.php?rand=<?php echo "".microtime(true); ?>');">隨機</div>
        <div class="smallbtn" onclick="RequestPractice('2.1.php?num=<?php echo "".($randomIndex+1); ?>');">下一個</div>
    </div>
</div>