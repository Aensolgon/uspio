<!DOCTYPE html>
<html>
<head>
    <title>Address Helper</title>
</head>
<?php
include 'app/resources/layouts/header.php';
?>
<body>
<div id="main-container">
    <div id="map" style="width:100%;height:88vh;"></div>
</div>
</body>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?php echo API_KEY; ?>&libraries=places&callback=initMap"></script>
<script src="/assets/js/map.js"></script>
<?php
include 'app/resources/layouts/footer.php';
?>
</html>
