
<?php
echo '<h2>選擇練習方式</h2>';
echo '<p style="margin-top:0; text-indent:0;">*練習需具有聲音播放裝置，請確認連接耳機或喇叭</p>';
echo '<div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'read\');"><h3>讀字練習</h3></div>';
echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'spell\');"><h3>聽寫（拼字）練習</h3></div>';
echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',[\'read\',\'spell\']);"><h3>綜合練習</h3></div>';
function PrintVoc(&$data, $start, $end)
{
    if(isset($data->{$_POST['ind']}->{'voc'}))
    {
        $arr_size = count($data->{$_POST['ind']}->{'voc'});
        for($i = $start; $i <= $end; $i++)
        {
            if($i < $arr_size)
            {
                $ele = ($data->{$_POST['ind']}->{'voc'})[$i];
                echo '<td><font class="soundtxt" data-surl="'.GetDataSurl($data, $i).'" onclick="PlayOrStopSound(this)">'.$ele->{'word'}.'</font>';
                if(isset($ele->{'hint'}))
                {
                    echo '<br>'.$ele->{'hint'}.'</td>';
                }
                else
                {
                    echo '</td>';
                }
            }
            else
            {
                echo '<td></td>';
            }
        }
    }
}
?>
<br>
<h2>字庫</h2>
<div class="tablecontainer">
    <table align="center">
        <tr><th>聲調</th>
            <th><font class="soundtxt" data-surl="3/3.0_14.mp3" onclick="PlayOrStopSound(this)">基調</font><img class="txt" src="Doo/SVG/kidiau.svg"></th>
            <th><font class="soundtxt" data-surl="3/3.0_16.mp3" onclick="PlayOrStopSound(this)">高調</font><img class="txt" src="Doo/SVG/koidiau.svg"></th>
            <th><font class="soundtxt" data-surl="3/3.0_18.mp3" onclick="PlayOrStopSound(this)">迴旋</font><img class="txt" src="Doo/SVG/hoesoaan.svg"></th>
            <th><font class="soundtxt" data-surl="3/3.0_20.mp3" onclick="PlayOrStopSound(this)">下突</font><img class="txt" src="Doo/SVG/haxdut.svg"></th>
            <th><font class="soundtxt" data-surl="3/3.0_22.mp3" onclick="PlayOrStopSound(this)">上突</font><img class="txt" src="Doo/SVG/sioxngdut.svg"></th>
            <th><font class="soundtxt" data-surl="3/3.0_24.mp3" onclick="PlayOrStopSound(this)">低促</font><img class="txt" src="Doo/SVG/kexchiog.svg"></th>
            <th><font class="soundtxt" data-surl="3/3.0_26.mp3" onclick="PlayOrStopSound(this)">高促</font><img class="txt" src="Doo/SVG/koichiog.svg"></th></tr>
        <tr><td>1.</td><?php PrintVoc($data, 0, 5); ?> <td><font class="soundtxt" data-surl="<?php echo GetDataSurl($data, 6); ?>" onclick="PlayOrStopSound(this)">kak</font>*<br>#掉*</td></tr>
        <tr><td>2.</td><?php PrintVoc($data, 7, 13); ?></tr>
        <tr><td>3.</td><?php PrintVoc($data, 14, 20); ?></tr>
        <tr><td>4.</td><?php PrintVoc($data, 21, 27); ?></tr>
        <tr><td>5.</td><?php PrintVoc($data, 28, 34); ?></tr>
        <tr><td>6.</td><?php PrintVoc($data, 35, 41); ?></tr>
        <tr><td>7.</td><?php PrintVoc($data, 42, 48); ?></tr>
    </table>
</div>
<p>*kak #掉： qioih'kak 無用之物，hiet'kak 丟棄</p>
