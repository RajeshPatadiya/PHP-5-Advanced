<?php
/**
 * Created by JetBrains PhpStorm.
 * User: danielehrlich1
 * Date: 8/3/13
 * Time: 5:31 PM
 * To change this template use File | Settings | File Templates.
 */

if (isset($_GET['symbol']) && !empty($_GET['symbol'])){

  // Identify the URL:
  $url = sprintf('http://quote.yahoo.com/d/quotes.csv?s=%s&f=nl1', $_GET['symbol']);

  // Open the "file"
  $fp = @fopen("$url", 'r') or die ('<p>Cannot access yahoo</p>');

  // Get the CSV file and convert to array
  $read = fgetcsv($fp);

  // Close the file
  fclose($fp);

  echo "The value of $read[0] is $read[1] which is $$read[1]";

}

?>

<form action="yahooStock.php" method="get">
  <label for="symbol">Enter Your Stock Here!!!</label>
  <input type="text" name="symbol" size="5" maxlength="5"/>
  <input type="submit" name="submit" value="Fetch the Quote!"/>
</form>