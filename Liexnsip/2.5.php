<div class="p-topbar"><h3>[練習2.5]</h3><h2>含後鼻音及單母音拼詞</h2></div>
<div style="width: 100%; height: calc(100% - 64px);">
    <div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center; width: 100%;">
        <div style="min-height: 100px;">
<?php
$json = 
'[
    {"word":"akim","sound":""},
    {"word":"angli","sound":""},
    {"word":"bunge","sound":""},
    {"word":"bunku","sound":""},
    {"word":"dengzoi","hint":"燈座","sound":""},
    {"word":"din\'ku","hint":"陳舊","sound":""},
    {"word":"engoe","sound":""},
    {"word":"gibun","sound":""},
    {"word":"ginzoi","sound":""},
    {"word":"hongho","sound":""},
    {"word":"hunbu","sound":""},
    {"word":"ienbu","hint":"煙霧","sound":""},
    {"word":"imho","hint":"陰雨","sound":""},
    {"word":"inui","sound":""},
    {"word":"iong\'i","sound":""},
    {"word":"jingi","sound":""},
    {"word":"kng\'iam","hint":"光艷","sound":""},
    {"word":"konggi","sound":""},
    {"word":"ongui","sound":""},
    {"word":"pangzo","sound":""},
    {"word":"pindoi","sound":""},
    {"word":"qinsi","sound":""},
    {"word":"qoanli","sound":""},
    {"word":"simpu","sound":""},
    {"word":"simsu","sound":""},
    {"word":"uiham","hint":"遺憾","sound":""},
    {"word":"dedang","sound":""},
    {"word":"ienbu","sound":""},
    {"word":"ienlo","sound":""},
    {"word":"oange","sound":""},
    {"word":"oanpi","sound":""},
    {"word":"phenggi","hint":"評議","sound":""},
    {"word":"sienle","sound":""},
    {"word":"tiendoi","sound":""},
    {"word":"zapan","hint":"查辦","sound":""}
]'
;
$soundpostfix = ".mp3";
$soundprefix = "LS2/ls2.5_";
$words = json_decode($json);
$randomIndex = rand ( 0, count($words)-1);
if(isset($_GET["num"]) && is_numeric($_GET["num"]))
{
    $randomIndex = $_GET["num"];
    if($randomIndex >= count($words)) $randomIndex = 0;
    if($randomIndex < 0) $randomIndex = count($words)-1;
}
echo '<audio autoplay><source src="Sviaym/'.$soundprefix.$randomIndex.$soundpostfix.'" type="audio/mpeg"></audio>';
echo "<h1 class='soundtxt playabletxt' onclick='PlayOrStopSound(this);' data-surl='".$soundprefix.$randomIndex.$soundpostfix."'>".$words[$randomIndex]->{'word'}."</h1>";
if(isset($words[$randomIndex]->{'hint'}))
{
    echo "<h3>".$words[$randomIndex]->{'hint'}."</h3>";
}
?>
</div>
        <div class="smallbtn" onclick="RequestPractice('2.5.php?num=<?php echo "".($randomIndex-1); ?>');">上一個</div>
        <div class="smallbtn" onclick="RequestPractice('2.5.php?rand=<?php echo "".microtime(true); ?>');">隨機</div>
        <div class="smallbtn" onclick="RequestPractice('2.5.php?num=<?php echo "".($randomIndex+1); ?>');">下一個</div>
    </div>
</div>