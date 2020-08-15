<div style="width: 100%; height: calc(100% - 60px); overflow: auto;">
<?php
//header
$has_data = false;
$data = array();
if(isset($_POST['ind']))
{
    //get and parse JSON
    $str = file_get_contents(''.intval($_POST['ind']).'.json');
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
<div style="position:relative; width: 100%; height: calc(100% - 80px); min-height: 500px;">
<div style="position: absolute; left: 50%; top:50%; transform: translate(-50%,-50%); text-align: center; width: 100%;">
<?php
    if($has_data && isset($data->{$_POST['ind']}->{'sentences'}))
    {
        if(isset($_POST['q']) && isset($_POST['ans']))
        {
            $index = explode("-", $_POST['q']);
            $ele = (($data->{$_POST['ind']}->{'sentences'})[$index[0]])[$index[1]];
            $qword = str_replace("'","",$ele->{'word'});
            $qword = str_replace(" ","",$qword);
            $aword = str_replace("'","",$_POST['ans']);
            $aword = str_replace(" ","",$aword);
            if(strcasecmp($qword,$aword) == 0)
            {
                echo '<div class="svg-box"><svg class="circular green-stroke"><circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10"/></svg><svg class="checkmark green-stroke"><g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-489.57,-205.679)"><path class="checkmark__check" fill="none" d="M616.306,283.025L634.087,300.805L673.361,261.53"/></g></svg></div>';
                echo '<h2>Dioih!</h2>';
                echo '<div id="questionsound" style="display: none;"  data-surl="dioih.mp3"></div>';
                echo '<br><div id="p-confirm" class="confirmbtn enabled" onclick="RequestPractice('.$_POST['ind'].',\'current\');"><h3>下一題</h3></div>';
                echo '<br><br><div class="backbtn" onclick="RequestPractice('.$_POST['ind'].',\'index\');">↺ 返回主頁</div>';
            }
            else
            {
                echo '<div class="svg-box"><svg class="circular red-stroke"><circle class="path" cx="75" cy="75" r="50" fill="none" stroke-width="5" stroke-miterlimit="10"/></svg><svg class="cross red-stroke"><g transform="matrix(0.79961,8.65821e-32,8.39584e-32,0.79961,-502.652,-204.518)"><path class="first-line" d="M634.087,300.805L673.361,261.53" fill="none"/></g><g transform="matrix(-1.28587e-16,-0.79961,0.79961,-1.28587e-16,-204.752,543.031)"><path class="second-line" d="M634.087,300.805L673.361,261.53"/></g></svg></div>';
                echo '<h2>Mxdioih...</h2>';
                echo '<div id="questionsound" style="display: none;"  data-surl="mxdioih.mp3"></div>';
                echo '<h3><s>'.$_POST['ans'].'</s> → '.$ele->{'word'}.'</h3>';
                echo '<br><div id="p-confirm" class="confirmbtn enabled" onclick="RequestPractice('.$_POST['ind'].',\'current\');"><h3>下一題</h3></div>';
                echo '<br><br><div class="backbtn" onclick="RequestPractice('.$_POST['ind'].',\'index\');">↺ 返回主頁</div>';
            }
        }
        else
        {
            $randomSIndex = rand ( 0, count($data->{$_POST['ind']}->{'sentences'})-1);
            $randomVIndex = rand ( 0, intdiv(count(($data->{$_POST['ind']}->{'sentences'})[$randomSIndex]),2)-1)*2+1;
            $ele = (($data->{$_POST['ind']}->{'sentences'})[$randomSIndex])[$randomVIndex];
            echo '<h2>請參考聲音及提示，於下方輸入空格中正確的台文字詞：</h2>';
            echo '<p style="line-height: 2.5em; font-size: 16pt;">';
            for($i = 0; $i < count(($data->{$_POST['ind']}->{'sentences'})[$randomSIndex]); $i++)
            {
                if($i == $randomVIndex)
                {
                    echo '<b>____';
                    if(isset($ele->{'hint'}))
                    {
                        echo '('.$ele->{'hint'}.')';
                    }
                    echo '____</b>';
                }
                else{
                    $val = ($data->{$_POST['ind']}->{'sentences'})[$randomSIndex][$i];
                    if(isset($val->{'word'}))
                    {
                        echo $val->{'word'};
                    }
                    else
                    {
                        echo $val;
                    }
                } 
            }
            echo '</p>';
            echo '<input type="text" id="p-input" autocomplete="off" placeholder="'.$ele->{'hint'}.'" maxlength="'.(strlen($ele->{'word'})+5).'"oninput="if(this.value.length>0) document.getElementById(\'p-confirm\').classList.add(\'enabled\'); else document.getElementById(\'p-confirm\').classList.remove(\'enabled\');"></input>';
            echo '<br><div id="p-confirm" class="confirmbtn" onclick="if(document.getElementById(\'p-input\').value.length>0) RequestPractice('.$_POST['ind'].',\'fillblank\',\''.$randomSIndex.'-'.$randomVIndex.'\',document.getElementById(\'p-input\').value);"><h3>確定</h3></div>';
            echo '<br><br><div class="backbtn" onclick="RequestPractice('.$_POST['ind'].',\'index\');">↺ 返回主頁</div>';
        }
    }
    else
    {
        echo '<h2>好像有什麼出錯了...</h2><h3>點擊下方結束練習以返回</h3>';
    }
?>
</div>
</div>
</div>