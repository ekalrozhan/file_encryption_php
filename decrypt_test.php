<?php
require __DIR__ . "/functions/decrypt.php";

mkdir("decrypted_file");



$allFiles = getDirContents("encrypted_file",);

function getDirContents($path)
{
    $rii = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));


    foreach ($rii as $file) {
        if (!$file->isDir()) {
            $file->getPathname();
            $filename = basename($file->getPathname());
            $explode = explode(".", $filename);

            $originalFileName = $explode[0] . "." . $explode[1];

            // decryptFile('encrypted_file.mp4', 'file.mp4', 'my-secret-key');
            decryptFile($file->getPathname(), "decrypted_file/$originalFileName", 'secret-key');
        }
    }

    echo "File decrypted!\n";
    echo 'Memory usage: ' . round(memory_get_usage() / 1048576, 2) . "M\n";
}
