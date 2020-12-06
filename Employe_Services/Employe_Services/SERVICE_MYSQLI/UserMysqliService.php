<?php
include_once('../DAO_MYSQLI/UserMysqliDAO.php');

class UserMysqliService
{
    public $userDAO;

    public function __construct()
    {
        $this->userDAO = new UserMysqliDAO();
    }

    public function rechercheUser($user) {
        try {
            $data = $this->userDAO->rechercheUser($user);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
        return $data;
    }

    public function connexion(User $user,$data){
        try {
            $passwordVerify = password_verify($user->getUserPassword(), $data["PASSWORD"]); 
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
        if ($passwordVerify) {
            return $data;
        }
    }

    public function inscriptionUser(User $user){
        try {
            $passwordHash = password_hash($user->getUserPassword(), PASSWORD_DEFAULT);
            $this->userDAO->inscriptionUser($user, $passwordHash);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }
}
