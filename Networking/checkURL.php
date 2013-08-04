<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
  <title>Validate URLs</title>
  <style type="text/css" title="text/css" media="all">
    .bad {
      color: #F30;
    }
    .good {
      color: #0C0;
    }
  </style>
</head>
<body>
<?php # Script 9.1 - check_urls.php

/*	This page validates a list of URLs.
 *	It uses fsockopen() and parse_url() to do so.
 */

// This function will try to connect to a URL:
function check_url ($url) {

  // Break the URL down into its parts:
  $url_pieces = parse_url ($url);

  // Set the $path and $port:
  $path = (isset($url_pieces['path'])) ? $url_pieces['path'] :  '/';
  $port = (isset($url_pieces['port'])) ? $url_pieces['port'] : 80;

  // Connect using fsockopen():
  if ($fp = @fsockopen ($url_pieces['host'], $port, $errno, $errstr, 30)) {

    // Send some data:
    $send = "HEAD $path HTTP/1.1\r\n";
    $send .= "HOST: {$url_pieces['host']}\r\n";
    $send .= "CONNECTION: Close\r\n\r\n";
    fwrite($fp, $send);

    // Read the response:
    $data = fgets ($fp, 128);
    print_r($data);
    echo "\n";

    // Close the connection:
    fclose($fp);

    // Return the response code:
    list($response, $code) = explode (' ', $data);

    if ($code == 200) {
      return array($code, 'good');
    } else {
      return array($code, 'bad');
    }

  } else { // No connection, return the error message:
    return array($errstr, 'bad');
  }

} // End of check_url() function.

// Create the list of URLs:
$urls = array (
  'http://zirzow.dyndns.org/php-general/NEWBIE/',
  'http://video.google.com/videoplay?docid=-5137581991288263801&q=loose+change',
  'http://www.securephpwiki.com/index.php/Email_Injection/',
  'http://www.uic.rsu.ru/doc/web/php_coding_standard.html',
  'http://nfl.dmcinsights.com/MadminY/',
  'http://seagull.phpkitchen.com/'
);

// Print a header:
echo '<h2>Validating URLs</h2>';

// Kill the PHP time limit:
set_time_limit(0);

// Validate each URL:
foreach ($urls as $url) {

  list($code, $class) = check_url ($url);
  echo "<p><a href=\"$url\" target=\"_new\">$url</a> (<span class=\"$class\">$code</span>)</p>\n";

}
?>
</body>
</html>
