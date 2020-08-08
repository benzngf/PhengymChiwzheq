<?php

require('common.php');

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

    echo '<div class="p-topbar"><h3>[轉調拼字練習 '.$_POST['ind'].']</h3>';

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

    if($has_data && isset($data->{$_POST['ind']}->{'voc'}))

    {

        if(isset($_POST['q']) && isset($_POST['ans']))

        {

            $index = explode("-", $_POST['q']);

            $ele = ($data->{$_POST['ind']}->{'voc'})[$index[0]];

            if($index[1]==0)

            {

                $qword = str_replace("'","",$ele->{'ga'});

                $aword = str_replace("'","",$_POST['ans']);

                $fullans = str_replace("?",$_POST['ans'],$ele->{'gq'});

            }

            else

            {

                $qword = str_replace("'","",$ele->{'za'});

                $aword = str_replace("'","",$_POST['ans']);

                $fullans = str_replace("?",$_POST['ans'],$ele->{'zq'});

            }

            $qword = str_replace(" ","",$qword);

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


                echo '<h3><s>'.$fullans.'</s> → '.(($index[1]==0)?$ele->{'goandiau'}:$ele->{'zoafndiau'}).'</h3>';

                echo '<br><div id="p-confirm" class="confirmbtn enabled" onclick="RequestPractice('.$_POST['ind'].',\'current\');"><h3>下一題</h3></div>';

                echo '<br><br><div class="backbtn" onclick="RequestPractice('.$_POST['ind'].',\'index\');">↺ 返回主頁</div>';

            }

        }

        else

        {

            function GetSInd($svalid,$groupind,$selfInd)

            {

                if($svalid[0] && $svalid[1])

                {

                    return $groupind*2 + $selfInd;

                }

                else

                {

                    return $groupind;

                }

            }

            $randomIndex = rand ( 0, count($data->{$_POST['ind']}->{'voc'})-1);

            $ele = ($data->{$_POST['ind']}->{'voc'})[$randomIndex];

            $randomType = 0;

            if(isset($ele->{'zq'}) && isset($ele->{'gq'}))

            {

                $randomType = rand(0,1);

            }

            else if(isset($ele->{'zq'}))

            {

                $randomType = 1;

            }

            $goandiau = $ele->{'goandiau'};

            $zoafndiau = $ele->{'zoafndiau'};

            if($randomType == 0)

            {

                $question = str_replace('?','____',$ele->{'gq'});

                $ans = $ele->{'ga'};

                $goandiau = $question;

            }

            else

            {

                $question = str_replace('?','____',$ele->{'zq'});

                $ans = $ele->{'za'};

                $zoafndiau = $question;

            }

            

            echo '<div style="display:inline-block; margin-right:10pt; margin-left:10pt;">';

            if(isset($ele->{'gq'}))

            {

                if(strlen($goandiau)>12)

                {

                    if(($data->{$_POST['ind']}->{'soundvalid'})[0])

                    {

                        echo '<div class="p-vocblock" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$randomIndex,0)).'" style="width:'.(strlen($goandiau)*15).'px;">';

                    }

                    else

                    {

                        echo '<div class="p-vocblock" style="cursor:default; width:'.(strlen($goandiau)*15).'px;">';

                    }

                }

                else

                {

                    if(($data->{$_POST['ind']}->{'soundvalid'})[0])

                    {

                        echo '<div class="p-vocblock" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$randomIndex,0)).'" onclick="PlayOrStopSound(this)">';

                    }

                    else

                    {

                        echo '<div class="p-vocblock" style="cursor:default;">';

                    }

                }

                echo '<div class="vbcontent">';

                echo '<h3>'.$goandiau.'</h3>';

                if(isset($ele->{'ghint'}))

                {

                    echo '<p>'.$ele->{'ghint'}.'</p>';

                }

                echo '</div>';

                if(($data->{$_POST['ind']}->{'soundvalid'})[0])

                {

                    echo '<div class="soundicon" style="position:absolute;right:0;bottom:0;"></div>';

                }

                echo '</div>';

            }

            else

            {

                if(($data->{$_POST['ind']}->{'soundvalid'})[0])

                {

                    echo '<h3 style="min-width:100px; display:inline-block; text-align:right;"><font class="soundtxt" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$randomIndex,0)).'">'.$goandiau.'</font></h3>';

                }

                else

                {

                    echo '<h3 style="min-width:100px; display:inline-block; text-align:right;">'.$goandiau.'</h3>';

                }

            }

            echo '<b style="fontsize:16pt;">→</b>';

            if(isset($ele->{'zq'}))

            {

                if(strlen($zoafndiau)>12)

                {

                    if(($data->{$_POST['ind']}->{'soundvalid'})[1])

                    {

                        echo '<div class="p-vocblock" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$randomIndex,1)).'" style="width:'.(strlen($zoafndiau)*15).'px;">';

                    }

                    else

                    {

                        echo '<div class="p-vocblock" style="cursor:default; width:'.(strlen($zoafndiau)*15).'px;">';

                    }

                }

                else

                {

                    if(($data->{$_POST['ind']}->{'soundvalid'})[1])

                    {

                        echo '<div class="p-vocblock" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$randomIndex,1)).'" onclick="PlayOrStopSound(this)">';

                    }

                    else

                    {

                        echo '<div class="p-vocblock" style="cursor:default;">';

                    }

                }

                echo '<div class="vbcontent">';

                echo '<h3>'.$zoafndiau;

                echo '</h3>';

                if(isset($ele->{'zhint'}))

                {

                    echo '<p>'.$ele->{'zhint'}.'</p>';

                }

                echo '</div>';

                if(($data->{$_POST['ind']}->{'soundvalid'})[1])

                {

                    echo '<div class="soundicon" style="position:absolute;right:0;bottom:0;"></div>';

                }

                echo '</div>';

            }

            else

            {

                echo '<h3 style="min-width:100px; display:inline-block; text-align:left;">'.$zoafndiau.'</h3>';

            }

            echo '</div><br>';

            if($randomType == 0)

            {

                echo '<h2>請於空格輸入____中正確的原調音：</h2>';

            }

            else

            {

                echo '<h2>請於空格輸入____中正確的轉調音：</h2>';

            }

            if($randomType == 0)

            {

                echo '<h3 style="display:inline-block">';

                echo str_replace("?",'',$ele->{'gq'});

                echo '</h3>';

            }

            echo '<input type="text" id="p-input" autocomplete="off" placeholder="Daibuun..." maxlength="'.(strlen($ans)+3).'" style="width:auto; display:inline-block; text-align:'.(($randomType == 0)? 'left':'right').';"

            oninput="if(this.value.length>0) document.getElementById(\'p-confirm\').classList.add(\'enabled\'); else document.getElementById(\'p-confirm\').classList.remove(\'enabled\');"></input>';

            if($randomType == 1)

            {

                echo '<h3 style="display:inline-block">';

                echo str_replace("?",'',$ele->{'zq'});

                echo '</h3>';

            }

            echo '<br><div id="p-confirm" class="confirmbtn" onclick="if(document.getElementById(\'p-input\').value.length>0) RequestPractice('.$_POST['ind'].',\'zoafndiau\',\''.$randomIndex.'-'.$randomType.'\',document.getElementById(\'p-input\').value);"><h3>確定</h3></div>';

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