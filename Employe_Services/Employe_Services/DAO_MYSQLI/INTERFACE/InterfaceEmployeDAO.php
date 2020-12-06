<?php
include_once('InterfaceCommunDAO.php');

interface InterfaceEmploye extends InterfaceCommun
{

    public static function getAffectedSup();
}
