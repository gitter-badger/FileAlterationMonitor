<?php

$f = new FileAlterationMonitor($MY_FOLDER_TO_MONITOR)

while (TRUE)
{
    sleep(1);

    if ($newFiles = $f->getNewFiles())
    {
        // Code to handle new files
        // $newFiles is an array that contains added files
    }

    if ($removedFiles = $f->getRemovedFiles())
    {
        // Code to handle removed files
        // $newFiles is an array that contains removed files
    }

    $f->updateMonitor();
}

?>
