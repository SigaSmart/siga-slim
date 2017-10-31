<?php

require __DIR__.'/path_loader.php';
require __DIR__.'/configuration.php';

if (!function_exists('base_url')) {
    function base_url($path='') {
       return sprintf("%s/%s", BASE_URL, $path);
    }
}

if (!function_exists('tag_src')) {
    function tag_src($src) {
        return sprintf("%s/%s", filter_input(INPUT_SERVER, 'DOCUMENT_ROOT'), $src);
    }
}
