<?php

require_once './app/models/partido.model.php';
require_once './app/views/partido.view.php';

class PartidoController {

    private $model;
    private $view;

    public function __construct() {

        $this->model = new PartidoModel();
        $this->view = new PartidoView();
    }


    
    function verificarsesion() {
        if (!isset($_SESSION['usuario'])) {
            header("Location: " . BASE_URL . "usuarios/login");
            die();
        }
    }



    // mostrar todos los partidos
    public function showPartidos() {

        // pide datos al model
        $partidos = $this->model->getPartidos();

        // manda datos a la view
        $this->view->showPartidos($partidos);
    }
    


    function showPartido($id) {
        $partido = $this->model->getPartido($id);
        if (!$partido) {
            $this->view->showError(" No se encontró el partido con ID $id");
            return;
        }
        $this->view->showPartido($partido);
    }



    function showAgregarPartido() {
        $this->verificarSesion();
        $estadios = $this->model->getEstadios();
        $this->view->showAgregarPartidos($estadios);
    }



    function addPartido() {
        $this->verificarSesion();
        if (!empty($_POST['equipo_local']) && !empty($_POST['equipo_visitante']) && !empty($_POST['fecha']) && !empty($_POST['id_estadio'])) {
            $equipo_local = $_POST['equipo_local'];
            $equipo_visitante = $_POST['equipo_visitante'];
            $fecha = $_POST['fecha'];
            $id_estadio = $_POST['id_estadio'];

            $this->model->addPartido($equipo_local, $equipo_visitante, $fecha, $id_estadio);
            header("Location: " . BASE_URL . "partidos");
        } else {
            $this->view->showError("Todos los campos son obligatorios");
        }
    }


    
    function eliminarPartido($id) {
        $this->verificarSesion();
        $partido = $this->model->getPartido($id);
        if (!$partido) {
            return $this->view->showError("No existe el partido con el id=$id");
        }
        $this->model->eliminarPartido($id);
        header("Location: " . BASE_URL . "partidos");
    }



    function showEditarPartido($id) {
        $this->verificarSesion();
        $partido = $this->model->getPartido($id);
        $estadios = $this->model->getEstadios();
        if (!$partido) {
            $this->view->showError(" No se encontró el partido con ID $id");
            return;
        }
        
        $this->view->showEditarPartido($partido, $estadios);
    }
    


    function editarPartido($id) {
        $this->verificarSesion();
        $partidoactual = $this->model->getPartido($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $equipo_local = $_POST['equipo_local'] ?? $partidoactual->equipo_local;
            $equipo_visitante = $_POST['equipo_visitante'] ?? $partidoactual->equipo_visitante;
            $fecha = $_POST['fecha'] ?? $partidoactual->fecha;
            $id_estadio = $_POST['id_estadio'] ?? $partidoactual->id_estadio;

            $this->model->editarPartido($id, $equipo_local, $equipo_visitante, $fecha, $id_estadio);
            header("Location: " . BASE_URL . "partidos");
        } else {
            echo "No se recibieron datos para actualizar el partido.";
        }
    }
}