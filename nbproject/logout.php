<?php
setcookie(session_name(), '', time()-42000, '/');

    echo "<script>window.location.href='index.php'</script>";
    exit;
?> 