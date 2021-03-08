<?php

// Inits content naming
$time = (new DateTime())->format('Ymd_His');
$logPath = './logs/' . $time . '.txt';
$archivePath = './archives/' . $time . '.zip';
$completeArchiveName = $time . '.zip';

// Creates dummy log file
file_put_contents($logPath, (new DateTime())->format(DATE_ATOM));

// Creates an archive with the log file
$archive = new ZipArchive();
$archive->open($archivePath, ZipArchive::CREATE);
$archive->addFile($logPath);
$state = $archive->close();

echo ($state) ? 'Archive well created.' : 'An error occurred';

// Returns archive to browser
header('Content-type: '. mime_content_type($archivePath));
header('Content-Disposition: attachment; filename=' . $completeArchiveName);
$response = readfile($archivePath);

echo $response ? 'File well sent.' : 'An error occurred.';
