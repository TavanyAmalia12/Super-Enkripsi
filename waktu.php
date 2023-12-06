<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Encryption and Decryption Time</title>
</head>

<body>
    <h2>Encryption and Decryption Time</h2>

    <?php
    // Display encryption time if defined
    if (isset($encryptionTime)) {
        echo "<p>Encryption Time: $encryptionTime seconds</p>";
    } else {
        echo "<p>Encryption Time: N/A</p>";
    }

    // Display decryption time if defined
    if (isset($decryptionTime)) {
        echo "<p>Decryption Time: $decryptionTime seconds</p>";
    } else {
        echo "<p>Decryption Time: N/A</p>";
    }
    ?>
</body>

</html>
