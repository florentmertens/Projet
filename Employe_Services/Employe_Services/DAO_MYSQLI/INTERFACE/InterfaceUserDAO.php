<?php

interface InterfaceUser{
    
    public static function connexionDB();

    public function rechercheUser(User $user);

    public function inscriptionUser(User $user, $passwordHash);

}