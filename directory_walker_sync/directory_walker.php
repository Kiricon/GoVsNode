<?php

$directoriesToScan = [];
$scanCount = 0;
$totalDirs = 1;

function scanDirectory($directoryName) {
    global $directoriesToScan, $scanCount, $totalDirs;

    $result = scandir($directoryName);

    if($result) {
        foreach($result as $path) {
            $realPath = $directoryName . "/" . $path;

            if(is_dir($realPath)) {
                if($path === ".." || $path === ".") {
                    continue;
                }

                $directoriesToScan[$realPath] = false;
                $totalDirs += 1;
            } else {
                echo "{$path}\n";
            }
        }
    } else {
        echo "{$directoryName} is not valid directory to scan!";
    }
}

$path = null;

if(isset($argv[1])) {
    $path = $argv[1];
} else {
    $path = "/Users/imattie";
}

$directoriesToScan[$path] = false;

echo "Scanning Recursively Path: {$path}\n";

$startTime = microtime(true);

while($scanCount < $totalDirs) {
    foreach($directoriesToScan as $path => $hasBeenScanned) {
        if(!$hasBeenScanned) {
            scanDirectory($path);
            $scanCount += 1;

            unset($directoriesToScan[$path]);
        } 
    }

    $_size = count($directoriesToScan);
}

$endTime = microtime(true);
$diff = $endTime - $startTime;

echo "Scan complete. Runtime: {$diff}s.";
echo "" . PHP_EOL;

