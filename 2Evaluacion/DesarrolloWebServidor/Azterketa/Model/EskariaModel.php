<?php
require_once 'connect_data.php';

class EskariaModel
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
     * Esta funcion devuelve un array de arrays asociativo con los datos de los productos.
     * 
     * @return bool devuelve los datos de la tabla arropa.
     */
    public function GetArropa()
    {
        $this->OpenConnect();
        $sql = "SELECT * FROM arropa";
        $result = $this->conn->query($sql);
        $this->CloseConnect();
        return $result;
    }

    /**
     * Esta funcion inserta un producto en la tabla arropa.
     * 
     * @param int $id: el id del producto.
     * @param string $izena: el nombre del producto.
     * @param float $prezioa: el precio del producto.
     * @return bool devuelve true si se ha insertado correctamente.
     */
    public function InsertArropa($id, $izena, $prezioa)
    {
        $this->OpenConnect();
        $sql = "INSERT INTO arropa (id, izena, prezioa) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iss", $id, $izena, $prezioa);
        $result = $stmt->execute();
        $this->CloseConnect();
        return $result;
    }

    /** 
     * Esta funcion inserta un pedido en la tabla eskariak.
     * 
     * @param int $id_erabiltzailea: el id del usuario que realiza el pedido.
     * @param int $id_arropa: el id del producto que se pide.
     * @param int $kantitatea: la cantidad de productos que se piden.
     * @return bool devuelve true si se ha insertado correctamente.
     */
    public function InsertEskaria($id_erabiltzailea, $id_arropa, $kantitatea)
    {
        $this->OpenConnect();
        $sql = "INSERT INTO eskariak (id_erabiltzailea, id_arropa, kantitatea) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iii", $id_erabiltzailea, $id_arropa, $kantitatea);
        $result = $stmt->execute();
        $this->CloseConnect();
        return $result;
    }

    /**
     * Esta funcion devuelve un array de arrays asociativo con los datos de los pedidos.
     * 
     * @return bool devuelve los datos de la tabla eskariak.
     */
    public function GetEskariak()
    {
        $this->OpenConnect();

        $sql = "SELECT 
                COALESCE(u.izena, '-') AS 'Erabiltzaile Izena',
                COALESCE(a.izena, '-') AS 'Produktua',
                COALESCE(e.kantitatea, 0) AS 'Kopurua'
                FROM erabiltzaileak u
                LEFT JOIN eskariak e ON u.id = e.id_erabiltzailea
                LEFT JOIN arropa a ON e.id_arropa = a.id
                ORDER BY u.id, e.id";

        $result = $this->conn->query($sql);
        $this->CloseConnect();
        return $result;
    }
}
