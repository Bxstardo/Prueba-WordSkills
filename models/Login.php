<?php

/**
 * modelo Login
 */
class Login
{
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new Database;
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }

    public function validateUser($data)
    {
        try {
            $strSql = "SELECT * From Users WHERE Id = '{$data['Id']}' AND PasswordUser = '{$data['PasswordUser']}' AND Rol = 'Administrator'";
            
            $query = $this->pdo->select($strSql);

            if(isset($query[0]->Id)) {
                $_SESSION['user'] = $query[0];
                return true;
            } else
                return 'Error al Iniciar Sesión. Verifique sus Credenciales';
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    
}
