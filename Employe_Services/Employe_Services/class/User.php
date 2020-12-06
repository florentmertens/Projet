<?php
class User  
{
    private $userName;
    private $userPassword;
    private $userProfil;

    //  User Name
    public function getUserName() : string
    {
        return $this->userName;
    }

    public function setUserName(string $userName) : self
    {
        $this->userName = $userName;

        return $this;
    }

    // User Password
    public function getUserPassword() : string
    {
        return $this->userPassword;
    }

    public function setUserPassword(string $userPassword) : self
    {
        $this->userPassword = $userPassword;

        return $this;
    }

    // User Profil
    public function getUserProfil() : string
    {
        return $this->userProfil;
    }

    public function setUserProfil(string $userProfil) : self
    {
        $this->userProfil = $userProfil;

        return $this;
    }
}
