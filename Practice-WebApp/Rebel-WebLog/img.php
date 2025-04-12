<?php
$imagePath = $_GET['img'];
# $imagePath = str_replace('../', '', $imagePath);
if (strstr($imagePath, '../') != False) {
    die('security failed!');
}
$imageData = file_get_contents('./statics/image' . $imagePath);
echo $imageData;
?>
