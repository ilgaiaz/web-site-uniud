<?php
    session_start();
    session_destroy();
    ?>
    <script>
        document.cookie = "username=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        window.location.href = "index.php";
    </script>
    <?php
?>