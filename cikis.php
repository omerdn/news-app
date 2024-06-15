<?php
session_start();
$_SESSION=array();
session_destroy();
echo '<script>
         alert("Çıkış yapıldı");
         window.location.href = "index.php";
      </script>';
?>