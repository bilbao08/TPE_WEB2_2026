<?php

class PartidoView {

    function showPartidos($partidos) {

        require './templates/partidos/partidos.phtml';
    }



    function showPartido($partido) {
        require './templates/partidos/partido.phtml';
    }

    

    function showAgregarPartidos($estadios) {
        require './templates/partidos/agregarPartido.phtml';
    }



    function showEditarPartido($partido, $estadios) {
        require './templates/partidos/editarPartido.phtml';
    }



    function showError($mensaje) {
        require './templates/partidos/error.phtml';
    }
}