<?php
include_once('InterfaceCommunSERVICE.php');

interface InterfaceEmployeSERVICE extends InterfaceCommunSERVICE
{

    public static function getAffectedSup();
}
