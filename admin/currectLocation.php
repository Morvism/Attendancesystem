<!DOCTYPE html>
<html lang="en">
<?php
require_once 'header.php';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://static.neshan.org/sdk/openlayers/5.3.0/ol.css" rel="stylesheet" type="text/css">
  <script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL"></script>
  <script src="https://static.neshan.org/sdk/openlayers/5.3.0/ol.js" type="text/javascript"></script>
</head>

<body>


  <script type="text/javascript">
    $.ajax({
      type: 'GET',
      dataType: "json",
      url: 'https://api.neshan.org/v5/reverse?lat=36.275791&lng=59.605358',
      headers: {
        "Api-Key": "service.f40c176fde70402c8f5154a53d795c61"
      },
      success: function(data, status, xhr) {
        console.log('data: ', data);
      }
    });
  </script>
</body>

</html>