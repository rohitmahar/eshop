<?php

/**
 * Get the path to a versioned Webpack file.
 *
 * @param  string  $file
 * @param  string  $buildDirectory
 * @return string
 *
 * @throws \InvalidArgumentException
 */
function webpack($file, $buildDirectory = 'build')
{
    static $manifest = [];
    static $manifestPath;

    if (empty($manifest) || $manifestPath !== $buildDirectory) {
        $path = public_path($buildDirectory.'/manifest.json');
        if (file_exists($path)) {
            $manifest = json_decode(file_get_contents($path), true);
            $manifestPath = $buildDirectory;
        }
    }
    $file = ltrim($file, 'build/');
    if (isset($manifest[$file])) {
        return '/'.trim($buildDirectory.'/'.$manifest[$file], '/');
    }

    $unversioned = public_path($file);
    if (file_exists($unversioned)) {
        return '/'.trim($file, '/');
    }

    throw new InvalidArgumentException("File {$file} not defined in asset manifest.");
}