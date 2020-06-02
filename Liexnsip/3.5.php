<?php
echo '<h2>選擇練習方式</h2>';
echo '<p style="margin-top:0; text-indent:0;">*練習需具有聲音播放裝置，請確認連接耳機或喇叭</p>';
echo '<div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'read\');"><h3>讀字練習</h3></div>';
echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'spell\');"><h3>聽寫（拼字）練習</h3></div>';
echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',[\'read\',\'spell\']);"><h3>綜合練習</h3></div>';
?>

<h2>題目列表</h2>
<div style="width: 80%; max-width: 750px; text-align: left; margin-left: auto; margin-right: auto; font-size: 1.17em;">
<?php
if(isset($data->{$_POST['ind']}->{'voc'}))
{
    $arr_size = count($data->{$_POST['ind']}->{'voc'});
    $row_size = floor($arr_size/5);
    for($i = 0 ; $i < $row_size ; $i++)
    {
        echo '<div class="flowcell-tab" style="width: 48%; min-width: 350px;">';
        $ele = ($data->{$_POST['ind']}->{'voc'})[$i*5];
        echo '<font class="soundtxt" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, $i*5).'">'.$ele->{'word'}.'</font>';
        echo ' → ';
        for($j = $i*5+1 ; $j < $i*5+4 ; $j++)
        {
            $ele = ($data->{$_POST['ind']}->{'voc'})[$j];
            echo '<font class="soundtxt" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, $j).'">'.$ele->{'word'}.'</font>';
            echo ' ─ ';
        }
        $ele = ($data->{$_POST['ind']}->{'voc'})[$i*5+4];
        echo '<font class="soundtxt" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, $i*5+4).'">'.$ele->{'word'}.'</font>';
        echo '</div>';
    }
}
?>

</div>
