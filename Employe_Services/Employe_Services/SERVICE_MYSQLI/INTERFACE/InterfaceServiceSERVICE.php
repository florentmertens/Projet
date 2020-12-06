<?php
include_once('InterfaceCommunSERVICE.php');


interface InterfaceServiceSERVICE extends InterfaceCommunSERVICE
{

    public static function getAffectedServices();
}
