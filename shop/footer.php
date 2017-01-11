<?php
/*
 * Tutaj zamieszczamy stopkę naszego sklepu
 * 
 */
//Zamykam połączenia z bazą tam gdzie zostało otworzone
if (isset($conn)) {
    $conn->close();
    $conn = null;
}
?>
<footer class="container-fluid text-center">
    <p>Michał & Karol Shop &copy; 2017 Powered by CodersLab </p>
</footer>