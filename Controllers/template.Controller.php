<?php

class ControllerTemplate
{
    public function ControllerTemplate()
    {
        include "Views/Template.php";
    }

    static public function ctrRecursos()
    {
        return "http://localhost/GIS/";
    }
}