<?php
    require_once 'lib/simple_html_dom/simple_html_dom.php';

    $url = 'https://dogovor24.kz';
    $data = file_get_html($url);
    if($data->innertext!='' and count($data->find('a'))){
        foreach($data->find('a') as $a){
            echo '<a href="https://dogovor24.kz'.$a->href.'">'.$a->plaintext.'</a></br>';
        }
}

?>
