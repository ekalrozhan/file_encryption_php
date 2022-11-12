<?php
require __DIR__ . "/functions/encrypt.php";

mkdir("encrypted_file");



$allFiles = getDirContents("original_file");



function getDirContents($path)
{
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));


    foreach ($rii as $file) {
        if (!$file->isDir()) {
            $file->getPathname();
            $filename = basename($file->getPathname());
            encryptFile($file->getPathname(), "encrypted_file/$filename.enc", 'secret-key');
        }
    }

    echo "File encrypted!\n";
    echo 'Memory usage: ' . round(memory_get_usage() / 1048576, 2) . "M\n";
}
