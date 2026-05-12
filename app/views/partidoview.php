<?php

class PartidoView {

    function showPartidos($partidos) {

        require './templates/partidos.phtml';
    }



    function showPartido($partido) {
        require './templates/partido.phtml';
    }

    

    function showAgregarPartidos($estadios) {
        require './templates/agregarPartido.phtml';
    }



    function showEditarPartido($partido, $estadios) {
        require './templates/editarPartido.phtml';
    }



    function showError($mensaje) {
        require './templates/error.phtml';
    }
}