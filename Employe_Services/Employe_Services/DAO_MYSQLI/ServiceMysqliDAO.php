<?php
include_once('../class/Service.php');
include_once('../DAO_MYSQLI/INTERFACE/InterfaceServiceDAO.php');
include_once('../class/DaoException.php');
include_once('../class/ServiceException.php');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class ServiceMysqliDAO implements InterfaceService
{
    public static function connexionDB()
    {
        try {
            $mysqli = new mysqli('$host', '$username', '$password', '$database');
        } catch (mysqli_sql_exception $e) {
            throw new ServiceException($e->getMessage(), $e->getCode());
        }
        return $mysqli;
    }

    public function add(Object $service)
    {
        $noserv = $service->getNoServ();
        $services = $service->getService();
        $ville = $service->getVille();

        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare("INSERT INTO SERVICES VALUES (?,?,?)");
            $stmt->bind_param('iss', $noserv, $services, $ville);
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
    }

    public function recherche1($noserv)
    {
        $service = new Service();

        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare("SELECT * FROM SERVICES WHERE NOSERV= ?");
            $stmt->bind_param('i', $noserv);
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_array(MYSQLI_ASSOC);
            $service->setNoServ($data["NOSERV"])->setService($data["SERVICE"])->setVille($data["VILLE"]);
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
        return $service;
    }


    public function update(Object $service)
    {
        $services = $service->getService();
        $ville = $service->getVille();
        $noserv = $service->getNoServ();

        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare("UPDATE SERVICES SET SERVICE=?,VILLE=? WHERE NOSERV= ?");
            $stmt->bind_param('ssi', $services, $ville, $noserv);
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
    }

    public function supp($noserv)
    {
        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare("DELETE FROM SERVICES WHERE NOSERV=?");
            $stmt->bind_param('i', $noserv);
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
    }

    // Méthode pour afficher le tableau

    public function rechercheTous()
    {
        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare('SELECT * FROM SERVICES');
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_all(MYSQLI_ASSOC);
            foreach ($data as $value) {
                $tab[] = $service = new Service();
                $service->setNoServ($value["NOSERV"])->setService($value["SERVICE"])->setVille($value["VILLE"]);
            }
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if (isset($mysqli)) {
                $mysqli->close();
            }
        }
        return $tab;
    }

    public static function getAffectedServices()
    {
        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare('SELECT DISTINCT NOSERV FROM EMPLOYE');
            $stmt->execute();
            $rs = $stmt->get_result();
            $i = 1;
            while ($data = $rs->fetch_array(MYSQLI_ASSOC)) {
                $array[$i] = $data["NOSERV"];
                $i++;
            }
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
        return $array;
    }
}
