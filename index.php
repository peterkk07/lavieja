
<?php include 'includes/header.php'?>

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-7">
            <h1 class="text-center">Juego de la Vieja</h1>
            <h3>Instrucciones:</h3>
            <ul class="instructions">
                <li>Dos jugadores juegan en el mismo ordenador, alternando turnos.</li>
                <li>Al seleccionar un espacio disponible en el tablero, se asignará el símbolo X u O dependiendo del jugador en turno.</li>
                <li>El primer jugador en completar 3 figuras seguidas de forma vertical, horizontal o diagonal , gana</li>
                <li>Puede seleccionar el botón de crear un nuevo juego en cualquier momento.</li>
            </ul>
        </div>
        <div class="col-xs-12 col-sm-5">
            <h3>Últimos ganadores:</h3>
            <div id="scores"></div>
        </div>
    </div>

    <div class="row top-30">
        <div class="col-xs-12 col-sm-4 config">
            <p>Configurar el color del tablero:</p>
            <div id="color-picker-component" class="input-group colorpicker-component drag-drop-item">
                <input id="colour" type="text" value="#38a677" class="form-control"/>
                <span class="input-group-addon"><i></i></span>
            </div>
            <div class="button">
                <button type="submit" id="color-game" class="input-group form-control btn btn-primary">Aceptar</button>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 turn">
            <div id="players">
                <p>Registro de turnos:</p>
                <table id="players_table" class="table top-10">
                    <tr>
                        <th>Jugador</th>
                        <th>Turno</th>
                    </tr>
                    <tr>
                        <td id="current_player">X</td>
                        <td id="current_round">10</td>
                    </tr>
                </table>
            </div>
            <div class="button-start">
                <button id="btn_new_game" class="btn btn-success">¡Crear nuevo juego!</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-sm-offset-3">
            <div id="winner_div">
                <h3>Resultado:</h3>
                <p id="winner_h">N</p>
            </div>
            <div id="winner_img" style="display: none;">
                <img class= "img-responsive" src="img/celebration.gif">
            </div>

            <div id="tie_img" style="display: none;">
                <img class= "img-responsive" src="img/tie.gif">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div id="board" style="display: none;">
                <form id="#table_form">
                    <input id="m_id" type="hidden" name="match_id" value=""/>
                    <input id="round" type="hidden" name="match_round" value="1"/>
                    <input id="status" type="hidden" name="match_status" value="IN_PROGRESS"/>
                    <input id="winner" type="hidden" name="match_winner" value="N"/>
                    <input id="cplayer" type="hidden" name="current_player" value="X"/>
                    <table id="game_table" class="table table-bordered">
                        <tr>
                            <td id="td_a1" class="stop">
                                <input type="hidden" name="a1" value=""/>
                                <p id="p_a1">X</p>
                            </td>
                            <td id="td_b1" class="stop">
                                <div>
                                    <input type="hidden" name="b1" value=""/>
                                    <p id="p_b1">X</p>
                                </div>
                            </td>
                            <td id="td_c1" class="stop">
                                <div>
                                    <input type="hidden" name="c1" value=""/>
                                    <p id="p_c1">X</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="td_a2" class="stop">
                                <div>
                                    <input type="hidden" name="a2" value=""/>
                                    <p id="p_a2">X</p>
                                </div>
                            </td>
                            <td id="td_b2" class="stop">
                                <div>
                                    <input type="hidden" name="b2" value=""/>
                                    <p id="p_b2">X</p>
                                </div>
                            </td>
                            <td id="td_c2" class="stop">
                                <div>
                                    <input type="hidden" name="c2" value=""/>
                                    <p id="p_c2">X</p>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td id="td_a3" class="stop">
                                <div>
                                    <input type="hidden" name="a3" value=""/>
                                    <p id="p_a3">X</p>
                                </div>
                            </td>
                            <td id="td_b3" class="stop">
                                <div>
                                    <input type="hidden" name="b3" value=""/>
                                    <p id="p_b3">X</p>
                                </div>
                            </td>
                            <td id="td_c3" class="stop">
                                <div>
                                    <input type="hidden" name="c3" value=""/>
                                    <p id="p_c3">X</p>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'?>