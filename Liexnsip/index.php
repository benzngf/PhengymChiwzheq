<?php
//header
$has_data = false;
$data = array();
if(isset($_POST['chap']) && $_POST['ind'])
{
    $str = file_get_contents($_POST['chap'].'.json');
    if($str !== false)
    {
        try
        {
            $data = json_decode($str);
            $has_data = isset($data->{$_POST['ind']});
        }
        catch (Exception $e)
        {

        }
    }
}
if(isset($_POST['ind']))
{
    //get and parse JSON
    echo '<div class="p-topbar"><h3>[練習'.$_POST['ind'].']</h3>';
    if($has_data)
    {
        echo '<h2>'.$data->{$_POST['ind']}->{'title'}.'</h2>';
    }
    echo '</div>';
}
else
{
    echo '<div class="p-topbar"><h2>Oops...</h2></div>';
}
?>

<div style="width: 100%; height: calc(100% - 128px); padding: 10px; overflow: auto; text-align: center;">
<?php
    if($has_data)
    {
        echo '<h2>選擇練習方式</h2>';
        echo '<p style="margin-top:0; text-indent:0;">*練習需具有聲音播放裝置，請確認連接耳機或喇叭</p>';
        echo '<div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'read\');"><h3>讀字練習</h3></div>';
        echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'spell\');"><h3>聽寫（拼字）練習</h3></div>';
        echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].',\'random\');"><h3>綜合練習</h3></div>';
        
        echo '<h2>字庫</h2>';
        $arr_size = count($data->{$_POST['ind']}->{'voc'});
        for($i = 0 ; $i < $arr_size ; $i++)
        {
            $ele = ($data->{$_POST['ind']}->{'voc'})[$i];
            echo '<div class="p-vocblock" onclick="PlayOrStopSound(this)" ';
            if(isset($ele->{'sound'}))
            {
                echo 'data-surl="'.$ele->{'sound'}.'">';
            }
            else
            {
                echo 'data-surl="'.$data->{$_POST['ind']}->{'soundprefix'}.$i.$data->{$_POST['ind']}->{'soundpostfix'}.'">';
            }
            echo '<div class="vbcontent">';
            echo '<h3>'.$ele->{'word'}.'</h3>';
            if(isset($ele->{'hint'}))
            {
                echo '<p>'.$ele->{'hint'}.'</p>';
            }
            echo '</div>';
            echo '<div class="soundicon" style="position:absolute;right:0;bottom:0;"></div>';
            echo '</div>';
        }
    }
    else
    {
        echo '<h2>好像有什麼出錯了...</h2><h3>點擊下方結束練習以返回</h3>';
    }
?>

</div>