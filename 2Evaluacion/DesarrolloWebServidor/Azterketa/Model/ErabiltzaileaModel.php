<?php
require_once 'connect_data.php';

class ErabiltzaileaModel
{
    private $conn;

    public function OpenConnect()
    {
        $connData = new connect_data();
        try {
            $this->conn = new mysqli($connData->host, $connData->userbbdd, $connData->passbbdd, $connData->ddbbname);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        $this->conn->set_charset("utf8");
    }

    public function CloseConnect()
    {
        $this->conn->close();
    }


    /**
     * Esta funcion devuelve un array asociativo con los datos del usuario.
     * Si el usuario y la contraseña son correctos.
     * 
     * @param string $user: el nombre del usuario.
     * @param string $pass: la contraseña del usuario.
     * @return array devuelve los datos del usuario si el usuario y la contraseña son correctos.
     */
    public function Login($user, $pass)
    {
        $this->OpenConnect();

        $sql = "SELECT * FROM erabiltzaileak WHERE izena = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Verificar la contraseña usando password_verify()
            if (password_verify($pass, $row['pasahitza'])) {
                $datosUser["id"] = $row['id'];
                $datosUser["user"] = $row['izena'];
                //$datosUser["pass"] = $row['pasahitza'];
                $datosUser["admin"] = $row['admin'];
                $stmt->close();
                $this->CloseConnect();
                return $datosUser;
            }
        }
        $stmt->close();
        $this->CloseConnect();
        return false; // user o contraseña incorrectos
    }
}
