<?php
    if(isset($data->{$_POST['ind']}->{'voc'}))
        {
            echo '<h2>請試著朗讀以下例句：</h2>';
            $arr_size = count($data->{$_POST['ind']}->{'voc'});
            for($i = 0 ; $i < $arr_size ; $i++)
            {
                $ele = ($data->{$_POST['ind']}->{'voc'})[$i];
                if(strlen($ele->{'word'})>12)
                {
                    echo '<div class="p-vocblock" style="height:90px; width: '.(strlen($ele->{'word'})*15).'px; max-width:80%;"onclick="PlayOrStopSound(this)" ';
                }
                else
                {
                    echo '<div class="p-vocblock" style="height:90px;" onclick="PlayOrStopSound(this)" ';
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

