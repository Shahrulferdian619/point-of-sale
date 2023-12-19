<?php

function converter($val){
    // dd($val);
    $rp = str_replace('Rp','', $val);
    $tit = str_replace('.','', $rp);
    return $tit;
}

function converterDiskon($val){
    // dd($val);
    $tit = str_replace('%','', $val);
    return $tit;
}