<?php

    const DRIKKEPOST = 'drikkepost';
    const VANDHANE = 'vandhane';

    class Proxy {

        public function Toilets() {
            $toilets = file_get_contents('http://wfs-kbhkort.kk.dk/k101/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=k101:toilet&outputFormat=json&SRSNAME=EPSG:4326');
            return $toilets;
        }

        public function Waterposts() {
            $waterposts = file_get_contents('http://wfs-kbhkort.kk.dk/k101/ows?service=WFS&version=1.0.0&request=GetFeature&typeName=k101:springv_drikkep&outputFormat=json&SRSNAME=EPSG:4326');

            $waterpostsArray = json_decode($waterposts, true);

            $result =
                array_filter(
                    $waterpostsArray['features'],
                    function($waterpost) {
                        return $waterpost['properties']['kategori'] === DRIKKEPOST;// || $waterpost['properties']['kategori'] === VANDHANE;
                    }
                );
            return json_encode($result);
        }
    }