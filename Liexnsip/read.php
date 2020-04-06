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
    echo '<div class="p-topbar"><h3>[讀字練習 '.$_POST['ind'].']</h3>';
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
	function addSelBtn(&$elem, $elemIndex, &$obj, $displayTxt) {
	    echo '<div class="p-vocblock p-selectable" onclick="PlayOrStopSound(this);
        if(curselected) curselected.classList.remove(\'p-selected\');
        curselected = this;
        this.classList.add(\'p-selected\');"
        style="width:120px;height:120px;" ';
        if(isset($elem->{'sound'}))
        {
            echo 'data-surl="'.$elem->{'sound'}.'">';
        }
        else
        {
            echo 'data-surl="'.$obj->{$_POST['ind']}->{'soundprefix'}.$elemIndex.$obj->{$_POST['ind']}->{'soundpostfix'}.'">';
        }
        echo '<div class="vbcontent">';
        echo '<div class="soundicon" style="width:80px;height:80px;display:inline-block;"></div>';
        echo '<p>'.$displayTxt.'</p>';
        echo '</div></div>';
	}

    if($has_data)
    {
        $qtype = "'read'";
        if(isset($_POST['rand']) && $_POST['rand'] == 1)
        {
            $qtype = "'random'";
        }
        if(isset($_POST['q']) && isset($_POST['ans']))
        {
            $ele = ($data->{$_POST['ind']}->{'voc'})[$_POST['q']];
            $qword = isset($ele->{'sound'})? $ele->{'sound'}:$data->{$_POST['ind']}->{'soundprefix'}.$_POST['q'].$data->{$_POST['ind']}->{'soundpostfix'};
            $aword = $_POST['ans'];
            if($qword == $aword)
            {
                echo '<h2>答對了</h2>';
                echo '<audio autoplay><source src="Sviaym/Right.mp3" type="audio/mpeg"></audio>';
                echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].','.$qtype.');"><h3>下一題</h3></div>';
            }
            else
            {
                echo '<h2>答錯了</h2>';
                echo '<audio autoplay><source src="Sviaym/Wrong.mp3" type="audio/mpeg"></audio>';
                $ele = ($data->{$_POST['ind']}->{'voc'})[$_POST['q']];
                echo '<div class="p-vocblock" onclick="PlayOrStopSound(this)" ';
                if(isset($ele->{'sound'}))
                {
                    echo 'data-surl="'.$ele->{'sound'}.'">';
                }
                else
                {
                    echo 'data-surl="'.$data->{$_POST['ind']}->{'soundprefix'}.$_POST['q'].$data->{$_POST['ind']}->{'soundpostfix'}.'">';
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
                echo '<br><div class="practicebtn" onclick="RequestPractice('.$_POST['ind'].','.$qtype.');"><h3>下一題</h3></div>';
            }
        }
        else
        {
            $randomIndex = rand ( 0, count($data->{$_POST['ind']}->{'voc'})-1);
            $ele = ($data->{$_POST['ind']}->{'voc'})[$randomIndex];
            echo '<h2>請選出 "'.$ele->{'word'}.'" 的正確讀音</h2>';
            $answerInd = rand ( 0, 4-1);
            for($i = 0 ; $i < 4 ; $i++)
            {
                if($i == $answerInd)
                {
                    $selIndex = $randomIndex;
                    $selEle = $ele;
                }
                else
                {
                    $selIndex = rand ( 0, count($data->{$_POST['ind']}->{'voc'})-2);
                    if($selIndex >= $randomIndex) $selIndex += 1;
                    $selEle = ($data->{$_POST['ind']}->{'voc'})[$selIndex];
                }
                addSelBtn($selEle,$selIndex,$data,$i+1);
            }
           
            echo '<br><div class="practicebtn" onclick="if(curselected){RequestPractice('.$_POST['ind'].',\'current\','.$randomIndex.',curselected.getAttribute(\'data-surl\'));curselected=null;}"><h3>確定</h3></div>';
        }
    }
    else
    {
        echo '<h2>好像有什麼出錯了...</h2><h3>點擊下方結束練習以返回</h3>';
    }
?>
</div>
</div>