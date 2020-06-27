<?php
echo '<div class="practicebtn" onclick="RequestPractice(\''.$_POST['ind'].'\',\'zoafndiau\');"><h3>開始練習</h3></div>';

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
if(isset($data->{$_POST['ind']}->{'voc'}))
{
    echo '<h2>字庫</h2>';
    echo '<div style="">';
    $arr_size = count($data->{$_POST['ind']}->{'voc'});
    for($i = 0 ; $i < $arr_size ; $i++)
    {
        echo '<div style="display:inline-block; margin-right:10pt; margin-left:10pt;">';
        $ele = ($data->{$_POST['ind']}->{'voc'})[$i];
        if(isset($ele->{'gq'}))
        {
            if(strlen($ele->{'goandiau'})>12)
            {
                if(($data->{$_POST['ind']}->{'soundvalid'})[0])
                {
                    echo '<div class="p-vocblock" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$i,0)).'" style="width:'.(strlen($ele->{'goandiau'})*15).'px;">';
                }
                else
                {
                    echo '<div class="p-vocblock" style="cursor:default; width:'.(strlen($ele->{'goandiau'})*15).'px;">';
                }
            }
            else
            {
                if(($data->{$_POST['ind']}->{'soundvalid'})[0])
                {
                    echo '<div class="p-vocblock" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$i,0)).'" onclick="PlayOrStopSound(this)">';
                }
                else
                {
                    echo '<div class="p-vocblock" style="cursor:default;">';
                }
            }
            echo '<div class="vbcontent">';
            echo '<h3>'.$ele->{'goandiau'};
            echo '</h3>';
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
                echo '<h3 style="min-width:100px; display:inline-block; text-align:right;"><font class="soundtxt" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$i,0)).'">'.$ele->{'goandiau'}.'</font></h3>';
            }
            else
            {
                echo '<h3 style="min-width:100px; display:inline-block; text-align:right;">'.$ele->{'goandiau'}.'</h3>';
            }
        }

        echo '<b style="fontsize:16pt;">→</b>';

        if(isset($ele->{'zq'}))
        {
            if(strlen($ele->{'zoafndiau'})>12)
            {
                if(($data->{$_POST['ind']}->{'soundvalid'})[1])
                {
                    echo '<div class="p-vocblock" onclick="PlayOrStopSound(this)" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$i,1)).'" style="width:'.(strlen($ele->{'zoafndiau'})*15).'px;">';
                }
                else
                {
                    echo '<div class="p-vocblock" style="cursor:default; width:'.(strlen($ele->{'zoafndiau'})*15).'px;">';
                }
            }
            else
            {
                if(($data->{$_POST['ind']}->{'soundvalid'})[1])
                {
                    echo '<div class="p-vocblock" data-surl="'.GetDataSurl($data, GetSInd($data->{$_POST['ind']}->{'soundvalid'},$i,1)).'" onclick="PlayOrStopSound(this)">';
                }
                else
                {
                    echo '<div class="p-vocblock" style="cursor:default;">';
                }
            }
            echo '<div class="vbcontent">';
            echo '<h3>'.$ele->{'zoafndiau'};
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
            echo '<h3 style="min-width:100px; display:inline-block; text-align:left;">'.$ele->{'zoafndiau'}.'</h3>';
        }
        echo '</div>';
    }
    echo '</div>';
}
?>