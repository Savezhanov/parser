<?php

include_once('lib/SQL.php');
include_once('lib/curl_query.php');
include_once('lib/simple_html_dom.php');

$sql = SQL::Instance();

$url = 'https://dogovor24.kz/documents';
$html = curl_get($url);
$dom = str_get_html($html);

$bd_maintitles = array();
$bd_foldertitles = array();

try {
    $link = $dom->find('.ds_document');
    $main_titles = $dom->find('.subsection');
    $main_folders = $dom->find('.commit');
    $submain_folders = $dom->find('.subcommit');
} catch (Exception $e) {
    echo $e;
}

//parsing main titles
foreach ($main_titles as $key => $titles) {
    try {
        $name_titles = $titles->find('.selected', 0);
    } catch (Exception $e) {
        echo $e;
    }
    $bd_maintitles[$key] = $name_titles->plaintext;
}

//parsing folder titles
foreach ($main_folders as $key => $folders) {
    $folder_titles = $folders->find('.collapsed',0);
    $bd_foldertitles[$key] = $folder_titles->plaintext;
    /*echo $bd_foldertitles[$key];*/
}

foreach ( $bd_maintitles as $key => $value ) {
    echo '<h2 style="font-weight: bold">'.$value .'</h2>';
    foreach ($bd_foldertitles as $keys => $bd_foldertitle){
        echo $bd_foldertitle.'<br>';
    }
}



