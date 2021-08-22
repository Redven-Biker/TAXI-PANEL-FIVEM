<?php
    session_destroy(); // Destroys all of the data associated with the current session.
    Header("Location:login"); //Sends you to login page.
?>