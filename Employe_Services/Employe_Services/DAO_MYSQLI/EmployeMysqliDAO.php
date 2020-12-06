<?php
include_once('../class/Employe.php');
include_once('../DAO_MYSQLI/INTERFACE/InterfaceEmployeDAO.php');
include_once('../class/DaoException.php');
include_once('../class/ServiceException.php');


mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class EmployeMysqliDAO implements InterfaceEmploye
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

    public function affichageFiltrage(Employe $employe, $service)
    {
        $nom = $employe->getNom();
        $prenom = $employe->getPrenom();
        $emploi = $employe->getEmploi();

        $mysqli = self::connexionDB();
        $stmt = $mysqli->prepare('SELECT e.* FROM EMPLOYE AS e INNER JOIN SERVICES AS s ON e.NOSERV=s.NOSERV WHERE (NOM LIKE ? OR NULL) AND (PRENOM LIKE ? OR NULL) AND (EMPLOI LIKE ? OR NULL) AND (SERVICE LIKE ? OR NULL)');
        $stmt->bind_param("ssss", $nom, $prenom, $emploi, $service);
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_all(MYSQLI_ASSOC);
        foreach ($data as $value) {
            $tab[] = $employe = new Employe();
            $employe->setNoEmp($value["NOEMP"])->setNom($value["NOM"])->setPrenom($value["PRENOM"])->setEmploi($value["EMPLOI"])->setSup($value["SUP"])->setEmbauche($value["EMBAUCHE"])->setSal($value["SAL"])->setComm($value["COMM"])->setNoServ($value["NOSERV"]);
        }
        $mysqli->close();
        return $tab;
    }

    public function count()
    {
        $date = date("Y-m-d");
        $mysqli = self::connexionDB();
        $stmt = $mysqli->prepare("SELECT COUNT(NOEMP) AS COMPTEUR FROM EMPLOYE WHERE DATE=?");
        $stmt->bind_param("s", $date);
        $stmt->execute();
        $rs = $stmt->get_result();
        $data = $rs->fetch_array(MYSQLI_ASSOC);
        $compteur = $data['COMPTEUR'];
        $mysqli->close();
        return $compteur;
    }

    public function add(Object $employe)
    {
        $noemp = $employe->getNoEmp();
        $nom = $employe->getNom();
        $prenom = $employe->getPrenom();
        $emploi = $employe->getEmploi();
        $sup = $employe->getSup();
        $embauche = $employe->getEmbauche();
        $sal = $employe->getSal();
        $comm = $employe->getComm();
        $noserv = $employe->getNoServ();
        $date = date('Y-m-d');

        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare("INSERT INTO EMPLOYE VALUES (?,?,?,?,?,?,?,?,?,?)");
            $stmt->bind_param('isssisiiis', $noemp, $nom, $prenom, $emploi, $sup, $embauche, $sal, $comm, $noserv, $date);
            $execute = $stmt->execute();
            if ($execute) {
            }
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
    }

    public function recherche1($noemp)
    {
        $employe = new Employe();

        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare('SELECT * FROM EMPLOYE WHERE NOEMP= ?');
            $stmt->bind_param('i', $noemp);
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_array(MYSQLI_ASSOC);
            $employe->setNoEmp($data["NOEMP"])->setNom($data["NOM"])->setPrenom($data["PRENOM"])->setEmploi($data["EMPLOI"])->setSup($data["SUP"])->setEmbauche($data["EMBAUCHE"])->setSal($data["SAL"])->setComm($data["COMM"])->setNoServ($data["NOSERV"]);
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
        return $employe;
    }

    public function update(Object $employe)
    {

        $nom = $employe->getNom();
        $prenom = $employe->getPrenom();
        $emploi = $employe->getEmploi();
        $sup = $employe->getSup();
        $embauche = $employe->getEmbauche();
        $sal = $employe->getSal();
        $comm = $employe->getComm();
        $noemp = $employe->getNoEmp();

        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare("UPDATE EMPLOYE SET NOM=?,PRENOM=?,EMPLOI=?,SUP=?,EMBAUCHE=?,SAL=?,COMM=? WHERE NOEMP= ?");
            $stmt->bind_param('sssisiii', $nom, $prenom, $emploi, $sup, $embauche, $sal, $comm, $noemp);
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
    }

    public function supp($noemp)
    {
        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare("DELETE FROM EMPLOYE WHERE NOEMP=?");
            $stmt->bind_param('i', $noemp);
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
            $stmt = $mysqli->prepare('SELECT * FROM EMPLOYE');
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_all(MYSQLI_ASSOC);
            foreach ($data as $value) {
                $tab[] = $employe = new Employe();
                $employe->setNoEmp($value["NOEMP"])->setNom($value["NOM"])->setPrenom($value["PRENOM"])->setEmploi($value["EMPLOI"])->setSup($value["SUP"])->setEmbauche($value["EMBAUCHE"])->setSal($value["SAL"])->setComm($value["COMM"])->setNoServ($value["NOSERV"]);
            }
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
        return $tab;
    }

    public static function getAffectedSup()
    {
        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare('SELECT DISTINCT SUP FROM EMPLOYE');
            $stmt->execute();
            $rs = $stmt->get_result();
            $i = 1;
            while ($data = $rs->fetch_array(MYSQLI_ASSOC)) {
                $array[$i] = $data["SUP"];
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
