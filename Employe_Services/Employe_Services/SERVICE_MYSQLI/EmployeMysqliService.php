<?php
include_once('../DAO_MYSQLI/EmployeMysqliDAO.php');
include_once('../class/ServiceException.php');

class EmployeMysqliService
{
    public $employeDAO;

    public function __construct()
    {
        return $this->employeDAO = new EmployeMysqliDAO();
    }

    public function affichageFiltrage(Employe $employe, $service)
    {
        return $this->employeDAO->affichageFiltrage($employe, $service);
    }

    public function count()
    {
        try {
            return $this->employeDAO->count();
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function add(Employe $employe)
    {
        try {
            $this->employeDAO->add($employe);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function recherche1($noemp)
    {
        try {
            return $this->employeDAO->recherche1($noemp);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function update(Employe $employe)
    {
        try {
            $this->employeDAO->update($employe);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function supp($noemp)
    {
        try {
            $this->employeDAO->supp($noemp);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function rechercheTous()
    {
        try {
            return $this->employeDAO->rechercheTous();
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function getAffectedSup()
    {
        try {
            return $this->employeDAO->getAffectedSup();
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }
}
