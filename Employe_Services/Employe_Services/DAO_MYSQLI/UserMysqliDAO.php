<?php
include_once('../class/User.php');
include_once('../DAO_MYSQLI/INTERFACE/InterfaceUserDAO.php');
include_once('../class/DaoException.php');
include_once('../class/ServiceException.php');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
class UserMysqliDAO implements InterfaceUser
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

    public function rechercheUser(User $user)
    {
        $userName = $user->getUserName();
        try {
            $mysqli = self::connexionDB();
            $stmt = $mysqli->prepare("SELECT * FROM USER WHERE USERNAME = ?");
            $stmt->bind_param('s', $userName);
            $stmt->execute();
            $rs = $stmt->get_result();
            $data = $rs->fetch_array(MYSQLI_ASSOC);
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
        return $data;
    }

    public function inscriptionUser(User $user, $passwordHash)
    {
        $userName = $user->getUserName();
        try {
            $mysqli = self::connexionDB();
            $profil = "User";
            $stmt = $mysqli->prepare("INSERT INTO USER VALUES (null,?,?,?)");
            $stmt->bind_param('sss', $userName, $passwordHash, $profil);
            $stmt->execute();
        } catch (mysqli_sql_exception $e) {
            throw new DaoException($e->getMessage(), $e->getCode());
        } finally {
            if ($mysqli) {
                $mysqli->close();
            }
        }
    }
}
