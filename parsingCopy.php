<?php
    include_once ('lib/simple_html_dom/simple_html_dom.php');
    include_once ('lib/curl_query/curl_query.php');

    $url = 'https://maint.kz';
    $html = curl_get('https://maint.kz');
    $dom = str_get_html($url);

    $links = $dom->find('a');

    foreach ($links as $key=>$value){
        /*$a = $value->find('a',0);*/
        echo  $a->href .'<br>';
    }

    /* Create DOM from URL or file
    $html = file_get_html('https://dogovor24.kz/documents');

    // Find all links
    foreach($html->find('a') as $element)
        echo $element->href . '<br>';*/

    /*require_once ('lib/simple_html_dom/simple_html_dom.php');

    $url = 'https://dogovor24.kz/documents';
    $html = file_get_html($url);
    $links = $html->find("h1");
    if(!empty($links)){
        echo $links[0];
    }else {
        echo "empty";
    }*/

?>