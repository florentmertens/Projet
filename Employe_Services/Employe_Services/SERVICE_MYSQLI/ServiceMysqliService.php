<?php
include_once('../DAO_MYSQLI/ServiceMysqliDAO.php');
include_once('../SERVICE_MYSQLI/INTERFACE/InterfaceServiceSERVICE.php');


class ServiceMysqliService
{
    public $serviceDAO;

    public function __construct()
    {
        return $this->serviceDAO = new ServiceMysqliDAO();
    }

    public function add($service)
    {
        try {
            $this->serviceDAO->add($service);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function recherche1($noserv)
    {
        try {
            return $this->serviceDAO->recherche1($noserv);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function update(Service $service)
    {
        try {
            $this->serviceDAO->update($service);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function supp($noserv)
    {
        try {
            $this->serviceDAO->supp($noserv);
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function rechercheTous()
    {
        try {
            return $this->serviceDAO->rechercheTous();
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }

    public function getAffectedServices()
    {
        try {
            return $this->serviceDAO->getAffectedServices();
        } catch (DaoException $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
    }
}
