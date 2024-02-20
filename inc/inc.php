<?php

function import_folder(string $dirname) {
    foreach (glob("{$dirname}/*.php") as $file) {
        include_once $file;
    }
}


import_folder("SimplePie");
