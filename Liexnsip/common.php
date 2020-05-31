<?php
function GetDataSurl(&$data, $index)
{
    $part = $data->{$_POST['ind']};
    if(isset($part->{'voc'}[$index]->{'sound'}))
    {
        return $part->{'voc'}[$index]->{'sound'};
    }
    if(isset($part->{'soundstartind'}))
    {
        return $part->{'soundprefix'}.($index+$part->{'soundstartind'}).$part->{'soundpostfix'};
    }
    else
    {
        return $part->{'soundprefix'}.$index.$part->{'soundpostfix'};
    }
}
?>