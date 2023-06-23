<!DOCTYPE html>
<html>
<head>
    <title>Address History</title>
</head>
<?php
include 'app/Resources/layouts/header.php';
?>
<body>
<div class="list wrapper">
    <h1>Address History</h1>
    <ol>
        <?php foreach ($history as $address): ?>
            <li><?php echo $address['address']; ?> - <?php echo $address['created_at']; ?></li>
        <?php endforeach; ?>
    </ol>
</div>
</body>
<?php
include 'app/Resources/layouts/footer.php';
?>
</html>
