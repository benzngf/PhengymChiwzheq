<?php
function GetDataSurl(&$data, $index, $append='')
{
    $part = $data->{$_POST['ind']};
    if(isset($part->{'voc'}[$index]->{'sound'}))
    {
        return $part->{'voc'}[$index]->{'sound'};
    }
    if(isset($part->{'soundstartind'}))
    {
        return $part->{'soundprefix'}.($index+$part->{'soundstartind'}).$append.$part->{'soundpostfix'};
    }
    else
    {
        return $part->{'soundprefix'}.$index.$append.$part->{'soundpostfix'};
    }
}
?>