<?php
if (isset($errors) && is_array($errors) && count($errors) > 0) {
    foreach ($errors as $error) {
        echo "<div class='alert alert-danger'>$error</div>";
    }
}
?>