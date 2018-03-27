<?php

include_once('lib/SQL.php');
include_once('lib/curl_query.php');
include_once('lib/simple_html_dom.php');

$sql = SQL::Instance();

$url = 'https://dogovor24.kz/documents';
$html = curl_get($url);
$dom = str_get_html($html);

try {
    $link = $dom->find('.ds_document');
    $main_titles = $dom->find('.subsection');
    $main_folders = $dom->find('.commit');
    $submain_folders = $dom->find('.subcommit');
} catch (Exception $e) {
    echo $e;
}

//parsing main titles
foreach ($main_titles as $key=>$titles) {

    try {
        $name_titles = $titles->find('.selected', 0);
    } catch (Exception $e) {
        echo $e;
    }
    echo $name_titles->plaintext;
    /*$tobd = array();
    if( ($name_titles->plaintext) != null ) {
        $tobd['main_title'] = $name_titles->plaintext;
    }
    var_dump($tobd);
    $sql ->Insert('main_titles',$tobd);*/
}

//parsing folder titles
foreach ($main_folders as $folders) {
    $folder_titles = $folders->find('.collapsed',0);
    /*echo $folder_titles->plaintext.'<br>';*/
}


//parsing links and parsing text from them
foreach ($link as $value) {
    //parsing all links
    $a = $value->find('a',0);
    //entering throw links
    $text = curl_get($a->href);
    $textdom = str_get_html($text);
    //parsing text
    try {
        $desc = $textdom -> find('.desc_body_wrap', 0 );
    } catch (Exception $e) {
        echo $e;
    }
    /*echo '<h1 style="background: #ff0000">'.$a->plaintext.'</h1>'.$desc.'<br>';*/
}

//inserting to BD
foreach ($link as $key=>$value) {
    echo $name_titles->plaintext .'<br>';
}



