<?php
  require_once 'YoutubeClient.php';
  $youtubeClient = new YoutubeClient();
?>

<!doctype html>
<html>
  <head>
    <title>My Uploads</title>
  </head>
  <body>
    <?php
      $body = $youtubeClient->showChannelList();
      echo $body;
    ?>
  </body>
</html>