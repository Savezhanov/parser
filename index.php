<?php
	/*
		Сайт уже обновился, поэтому такая версия работать не будет
	*/

	include_once('lib/SQL.php');
	include_once('lib/curl_query.php');
	include_once('lib/simple_html_dom.php');

/*	$sql = SQL::Instance();*/

	$url = 'https://dogovor24.kz/documents';
	$html = curl_get($url);
	$dom = str_get_html($html);

	try {
        $link = $dom->find('.ds_document');
    } catch (Exception $e) {
	    echo $e;
	}

	foreach ($link as $value) {
        $a = $value->find('a',0);
        /*echo '<a href="'.$a->href.'">'.$a->plaintext.'</a></br>';*/

        $text = curl_get($a->href);
        $textdom = str_get_html($text);

        try {
            $desc = $textdom -> find('.desc_body_wrap', 0 );
        } catch (Exception $e) {
            echo $e;
        }

        echo '<h1 style="background: #ff0000">'.$a->plaintext.'</h1>'.' ' . $desc;
        /*file_put_contents('test',$text);
        break;*/
    }

	/*foreach($courses as $course){
		$tobd = array('id_school' => 1);
		
		$a = $course->find('a', 0);	
		$tobd['name'] = $a->plaintext;
		
		$one = curl_get('http://ntschool.ru' . $a->href);		
		$one_dom = str_get_html($one);
		
		$cost = $one_dom->find('.cost', 0);
		$tobd['cost'] = (int)$cost->plaintext;
		$sql->Insert('courses', $tobd);
	}*/
	
