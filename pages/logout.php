<?php
session_start();
session_unset();      // Barcha session o'zgaruvchilarini tozalaydi
session_destroy();    // Sessionni yakunlaydi

// Login sahifaga yo'naltirish
header("Location: login.php");
exit;
