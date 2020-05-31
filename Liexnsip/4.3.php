<?php
    if(isset($data->{$_POST['ind']}->{'voc'}))
        {
            echo '<h2>題目列表</h2>';
            $arr_size = count($data->{$_POST['ind']}->{'voc'});
            for($i = 0 ; $i < $arr_size ; $i++)
            {
                $ele = ($data->{$_POST['ind']}->{'voc'})[$i];
                if(strlen($ele->{'word'})>12)
                {
                    echo '<div class="p-vocblock" style="width: '.(strlen($ele->{'word'})*15).'px;"onclick="PlayOrStopSound(this)" ';
                }
                else
                {
                    echo '<div class="p-vocblock" onclick="PlayOrStopSound(this)" ';
                }
                echo 'data-surl="'.GetDataSurl($data, $i).'">';
                echo '<div class="vbcontent">';
                echo '<h3>'.$ele->{'word'}.'</h3>';
                if(isset($ele->{'hint'}))
                {
                    echo '<p>'.$ele->{'hint'}.'</p>';
                }
                echo '</div>';
                echo '<div class="soundicon" style="position:absolute;right:0;bottom:0;"></div>';
                echo '</div>';
                if(isset($ele->{'br'}))
                {
                    echo '<br>';
                }
            }
        }
?>
<br>
<div class="practicebtn" onclick="RequestPractice('4.3','index');"><h3>開始練習</h3></div>
