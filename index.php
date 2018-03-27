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
    $bd_documents = array();

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
        if( ($name_titles->plaintext) != null ) {
            $bd_maintitles['main_title'] = $name_titles->plaintext;
        }
        $sql ->Insert('main_titles',$bd_maintitles);
    }

    //parsing folder titles
    foreach ($main_folders as $folders) {
        try {
            $folder_titles = $folders->find('.collapsed',0);
        } catch (Exception $e) {
            echo $e;
        }
        if( ($folder_titles->plaintext) != null ) {
            $bd_foldertitles['folder_title'] = $folder_titles->plaintext;
        }
        $sql ->Insert('folder_titles',$bd_foldertitles);
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
        if( ( ($a->plaintext) != null ) && ($desc != null ) ) {
            $bd_documents['documents_title'] = $a->plaintext;
            $bd_documents['documents_file'] = $desc;
        }
        $sql ->Insert('documents',$bd_documents);
        /*echo '<h1 style="background: #ff0000">'.$a->plaintext.'</h1>'.$desc.'<br>';*/
    }
