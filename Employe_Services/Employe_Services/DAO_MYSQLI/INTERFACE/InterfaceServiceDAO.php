<?php
include_once('InterfaceCommunDAO.php');


interface InterfaceService extends InterfaceCommun
{

    public static function getAffectedServices();
}
