<?php

if (!empty($_GET)) {
    header('Content-Type: application/json');
    require_once 'Proxy.php';
    switch (key($_GET)) {
        case 'toilets':
            $proxy = new Proxy();
            $toilets = $proxy->Toilets();

            echo ($toilets);
            break;
        case 'waterposts':
            $proxy = new Proxy();
            $waterposts = $proxy->Waterposts();

            echo ($waterposts);
            break;

    }


} else {
    $error = array('error' => 'Nothing here' );
    echo json_encode($error);
}