<?php

interface InterfaceCommunSERVICE{

    public static function connexionDB();

    public function recherche1($int);

    public function rechercheTous();

    public function supp($int);

    public function add(Object $object);

    public function update(Object $object);
}