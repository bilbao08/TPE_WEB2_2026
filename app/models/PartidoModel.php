<?php

class PartidoModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=partidos_db;charset=utf8', 'root', '');}


    public function getPartidos() {//funcion para traer todos los partidos
        $query = $this->db->prepare('SELECT p.*, e.nombre AS estadio
            FROM partidos p
            JOIN estadios e
            ON p.id_estadio = e.id_estadio');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
}