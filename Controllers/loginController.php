<?php
class loginController
{
    public function cerrarSesionControlador()
    {
        session_destroy();
        header("\114\x6f\x63\141\164\x69\x6f\156\72\40\x6c\x6f\147\151\x6e\x2e\160\150\x70");
    }
}
