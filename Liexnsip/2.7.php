<div class="p-topbar"><h3>[練習2.7]</h3><h2>含複母音及後鼻音拼詞</h2></div>
<div style="width: 100%; height: calc(100% - 64px);">
    <div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center; width: 100%;">
        <div style="min-height: 100px;">
<?php
$json = 
'[
    {"word":"ciaujin","sound":""},
    {"word":"cienau","sound":""},
    {"word":"duijin","hint":"追認","sound":""},
    {"word":"ganliau","sound":""},
    {"word":"goanzoe","sound":""},
    {"word":"hamsiu","sound":""},
    {"word":"hiauheng","sound":""},
    {"word":"hienhoe","sound":""},
    {"word":"himsien","sound":""},
    {"word":"honghai","sound":""},
    {"word":"hunhau","sound":""},
    {"word":"ioidang","sound":""},
    {"word":"iongmau","sound":""},
    {"word":"kuihoan","sound":""},
    {"word":"kunhau","sound":""},
    {"word":"lienlui","sound":""},
    {"word":"longhoe","sound":""},
    {"word":"longpoe","sound":""},
    {"word":"oangoe","sound":""},
    {"word":"phangsiu","sound":""},
    {"word":"pundvoa","hint":"怠惰","sound":""},
    {"word":"qangui","sound":""},
    {"word":"qimpoe","hint":"欽佩","sound":""},
    {"word":"sengciu","sound":""},
    {"word":"siangpoe","sound":""},
    {"word":"sin\'oe","sound":""},
    {"word":"sinsia","sound":""},
    {"word":"sioikang","hint":"相同","sound":""},
    {"word":"sionghai","sound":""},
    {"word":"siuheng","sound":""},
    {"word":"tamnoa","hint":"痰涎","sound":""},
    {"word":"tiamsiu","sound":""},
    {"word":"toansiu","sound":""},
    {"word":"unhui","sound":""},
    {"word":"viabin","hint":"贏面","sound":""},
    {"word":"zengoe","sound":""},
    {"word":"zengqu","hint":"舂臼","sound":""},
    {"word":"zhaideng","sound":""},
    {"word":"zhanhvoa","hint":"田埂","sound":""},
    {"word":"zhunsia","sound":""}
]'
;
$soundpostfix = ".mp3";
$soundprefix = "LS2/ls2.7_";
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
        <div class="smallbtn" onclick="RequestPractice('2.7.php?num=<?php echo "".($randomIndex-1); ?>');">上一個</div>
        <div class="smallbtn" onclick="RequestPractice('2.7.php?rand=<?php echo "".microtime(true); ?>');">隨機</div>
        <div class="smallbtn" onclick="RequestPractice('2.7.php?num=<?php echo "".($randomIndex+1); ?>');">下一個</div>
    </div>
</div>