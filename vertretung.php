<?php
  header('Content-Type: application/rss+xml;charset= utf-8 ');
  date_default_timezone_set('Europe/Berlin');
  $timestamp = file_get_contents("lastModified.txt");
  $modDate = date(DATE_RFC1123, $timestamp);
?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>

<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
  <title>Vertretungsplan</title>
  <link>http://www.bsztw-riesa.de/Vertretungsplaene/vertretung.pdf?<?php echo $timestamp ?></link>
  <description>wurde geändert</description>
  <lastBuildDate><?php echo $modDate ?></lastBuildDate>
  <item>
    <title><?php echo date("d.m.Y H:i", $timestamp); ?> Uhr veröffentlicht.</title>
    <link>http://www.bsztw-riesa.de/Vertretungsplaene/vertretung.pdf?<?php echo $timestamp ?></link>
    <description>Neue Vertretungsplan um <?php echo date("d.m.Y H:i", $timestamp); ?> Uhr veröffentlicht.</description>
    <pubDate><?php echo $modDate ?></pubDate>
  </item>
  <atom:link href="<?php echo $url = "http" . (($_SERVER['SERVER_PORT']==443) ? "s://" : "://") . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>" rel="self" type="application/rss+xml" />
</channel>
</rss>