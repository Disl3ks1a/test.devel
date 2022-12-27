<?php
if ($_FILES) {
    $name = $_FILES['filename']['name'];
    move_uploaded_file($_FILES['filename']['tmp_name'], $name);
    echo "Загруженный файл: '$name'<br><img src='$name'>";
}

echo "</body></html>";
require 'upload_file.html';