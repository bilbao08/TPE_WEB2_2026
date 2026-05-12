<?php

class PartidoModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=partidos_db;charset=utf8', 'root', '');}


    function getPartidos() {//funcion para traer todos los partidos
        $query = $this->db->prepare('SELECT p.*, e.nombre AS estadio
            FROM partidos p
            JOIN estadios e
            ON p.id_estadio = e.id_estadio');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    function getPartido($id) {//funcion para traer un partido por id
        $query = $this->db->prepare('SELECT p.*, e.nombre AS estadio
            FROM partidos p
            JOIN estadios e
            ON p.id_estadio = e.id_estadio
            WHERE p.id_partido = ?');
        $query->execute([$id]);
        return $query->fetch(PDO::FETCH_OBJ);
    }



    function getEstadios() {
        $query = $this->db->prepare('SELECT * FROM estadios');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }



    function addpartido($equipo_local, $equipo_visitante, $fecha, $id_estadio) {
        $query = $this->db->prepare('INSERT INTO partidos (equipo_local, equipo_visitante, fecha, id_estadio) VALUES (?, ?, ?, ?)');
        $query->execute([$equipo_local, $equipo_visitante, $fecha, $id_estadio]);
    }



    function eliminarPartido($id) {
        $query = $this->db->prepare('DELETE FROM partidos WHERE id_partido = ?');
        $query->execute([$id]);
    }


    
    function editarPartido($id, $equipo_local, $equipo_visitante, $fecha, $id_estadio) {
        $query = $this->db->prepare('UPDATE partidos SET equipo_local = ?, equipo_visitante = ?, fecha = ?, id_estadio = ? WHERE id_partido = ?');
        $query->execute([$equipo_local, $equipo_visitante, $fecha, $id_estadio, $id]);
    }