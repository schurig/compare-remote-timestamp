<?php
date_default_timezone_set('Europe/Berlin');
$curl = curl_init('http://www.bsztw-riesa.de/Vertretungsplaene/vertretung.pdf');

// don't fetch the actual page, you only want headers
curl_setopt($curl, CURLOPT_NOBODY, true);
// stop it from outputting stuff to stdout
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// attempt to retrieve the modification date
curl_setopt($curl, CURLOPT_FILETIME, true);

$result = curl_exec($curl);

if ($result === false) {
    die (curl_error($curl));
}

$remoteTimestamp = curl_getinfo($curl, CURLINFO_FILETIME);

if ($remoteTimestamp != -1) {

    $localTimestamp = file_get_contents(realpath(dirname(__FILE__)) . '/lastModified.txt');

    if($remoteTimestamp != $localTimestamp) {

      $my_file = realpath(dirname(__FILE__)) . '/lastModified.txt'; // need absolute path for cronjob
      $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
      $data = $remoteTimestamp;
      fwrite($handle, $data);
    }

}

?>