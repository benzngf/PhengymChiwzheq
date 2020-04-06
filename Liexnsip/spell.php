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
    echo '<div class="p-topbar"><h3>[聽寫（拼字）練習 '.$_POST['ind'].']</h3>';
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

<div style="position:relative; width: 100%; height: calc(100% - 128px);">
<div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center; width: 100%;">
<?php
    if($has_data)
    {
        $qtype = "'spell'";
        if(isset($_POST['rand']) && $_POST['rand'] == 1)
        {
            $qtype = "'random'";
        }
        if(isset($_POST['q']) && isset($_POST['ans']))
        {
            $ele = ($data->{$_POST['ind']}->{'voc'})[$_POST['q']];
            $qword = str_replace("'","",$ele->{'word'});
            $qword = str_replace(" ","",$qword);
            $aword = str_replace("'","",$_POST['ans']);
            $aword = str_replace(" ","",$aword);
            if(strcasecmp($qword,$aword) == 0)
            {
                echo '<h2>答對了</h2>';
                echo '<audio autoplay><source src="Sviaym/Right.mp3" type="audio/mpeg"></audio>';
                echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].','.$qtype.');"><h3>下一題</h3></div>';
            }
            else
            {
                echo '<h2>答錯了</h2>';
                echo '<h3><s>'.$_POST['ans'].'</s> → '.$ele->{'word'}.'</h3>';
                echo '<audio autoplay><source src="Sviaym/Wrong.mp3" type="audio/mpeg"></audio>';
                echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].','.$qtype.');"><h3>下一題</h3></div>';
            }
        }
        else
        {
            $randomIndex = rand ( 0, count($data->{$_POST['ind']}->{'voc'})-1);
            $ele = ($data->{$_POST['ind']}->{'voc'})[$randomIndex];
            
            echo '<div id="questionsound" class="p-vocblock" onclick="PlayOrStopSound(this)" style="width:120px;height:120px;" ';
            if(isset($ele->{'sound'}))
            {
                echo 'data-surl="'.$ele->{'sound'}.'">';
            }
            else
            {
                echo 'data-surl="'.$data->{$_POST['ind']}->{'soundprefix'}.$randomIndex.$data->{$_POST['ind']}->{'soundpostfix'}.'">';
            }
            
            echo '<div class="vbcontent">';
            
            echo '<div class="soundicon" style="width:80px;height:80px;display:inline-block;"></div>';
            if(isset($ele->{'hint'}))
            {
                echo '<p>'.$ele->{'hint'}.'</p>';
            }
            echo '</div></div>';
            echo '<h2>請於下方輸入聽到的台文字詞：</h2>';
            echo '<input type="text" id="p-input" autocomplete="off" placeholder="Daibuun..." maxlength="'.(strlen($ele->{'word'})+5).'" onkeypress="if (event.keyCode == 13) {
                if(this.value.length>0) RequestPractice('.$_POST['ind'].','.$qtype.','.$randomIndex.',document.getElementById(\'p-input\').value);
            }"></input>';
            echo '<br><div class="practicebtn" onclick="if(document.getElementById(\'p-input\').value.length>0) RequestPractice('.$_POST['ind'].',\'current\','.$randomIndex.',document.getElementById(\'p-input\').value);"><h3>確定</h3></div>';
        }
    }
    else
    {
        echo '<h2>好像有什麼出錯了...</h2><h3>點擊下方結束練習以返回</h3>';
    }
?>
</div>
</div>