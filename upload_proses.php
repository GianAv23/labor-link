<?php

$filename = $_FILES['foto']['name'];
$temp_file = $_FILES['foto']['name'];

move_uploaded_file($temp_file, "file_upload/{$filename}");
