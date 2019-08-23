$(document).ready(function () {
    getLatestMatch();
    getMatchScore();
    getConfig();

    $("#td_a1").on('click', function () {
        if($("#p_a1").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_a1").text(player)
            $('input[name="a1"]').val(player);
            updateGame();
        }
    });

    $("#td_a2").on('click', function () {
        if($("#p_a2").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_a2").text(player)
            $('input[name="a2"]').val(player);
            updateGame();
        }
    });

    $("#td_a3").on('click', function () {
        if($("#p_a3").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_a3").text(player)
            $('input[name="a3"]').val(player);
            updateGame();
        }
    });

    $("#td_b1").on('click', function () {
        if($("#p_b1").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_b1").text(player)
            $('input[name="b1"]').val(player);
            updateGame();
        }
    });

    $("#td_b2").on('click', function () {
        if($("#p_b2").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_b2").text(player)
            $('input[name="b2"]').val(player);
            updateGame();
        }
    });

    $("#td_b3").on('click', function () {
        if($("#p_b3").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_b3").text(player)
            $('input[name="b3"]').val(player);
            updateGame();
        }
    });

    $("#td_c1").on('click', function () {
        if($("#p_c1").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_c1").text(player)
            $('input[name="c1"]').val(player);
            updateGame();
        }
    });

    $("#td_c2").on('click', function () {
        if($("#p_c2").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_c2").text(player)
            $('input[name="c2"]').val(player);
            updateGame();
        }
    });

    $("#td_c3").on('click', function () {
        if($("#p_c3").text() === '' && $("#winner_h").text() === 'N'){
            var player = $('input[name="current_player"]').val();
            $("#p_c3").text(player)
            $('input[name="c3"]').val(player);
            updateGame();
        }
    });

    $("#btn_new_game").on('click', function () {
        clearBoard();
        $("#board").show();
        newGame();
        getMatchScore();
        getConfig();
    });

    function fillMatchData(data) {
        //CELDAS
        $("#p_a1").text(data.a1);
        $("#p_b1").text(data.b1);
        $("#p_c1").text(data.c1);
        $("#p_a2").text(data.a2);
        $("#p_b2").text(data.b2);
        $("#p_c2").text(data.c2);
        $("#p_a3").text(data.a3);
        $("#p_b3").text(data.b3);
        $("#p_c3").text(data.c3);
        $("#current_player").text(data.current_player);
        $("#current_round").text(data.match_round);
        if(data.match_winner !== 'N'){
            $("#winner_h").text('GANADOR! : Jugador ' + data.match_winner);
            $("#winner_div").show();
            $("#winner_img").show();
            getMatchScore();
        }
        if(data.match_winner === 'N' && data.match_round === 10){
            $("#winner_h").text("EMPATE");
            $("#winner_div").show();
            $("#tie_img").show();

        }

        $('input[name="a1"]').val(data.a1);
        $('input[name="b1"]').val(data.b1);
        $('input[name="c1"]').val(data.c1);
        $('input[name="a2"]').val(data.a2);
        $('input[name="b2"]').val(data.b2);
        $('input[name="c2"]').val(data.c2);
        $('input[name="a3"]').val(data.a3);
        $('input[name="b3"]').val(data.b3);
        $('input[name="c3"]').val(data.c3);
        $('input[name="match_id"]').val(data.id);
        $('input[name="match_round"]').val(data.match_round);
        $('input[name="match_status"]').val("IN_PROGRESS");
        $('input[name="match_winner"]').val(data.match_winner);
        $('input[name="current_player"]').val(data.current_player);
    }

    function getLatestMatch() {
        $.ajax({
            type: "GET",
            url: "php/getMatch.php",
            dataType: 'json',
            success: function (data) {
                if(data != null){
                    $("#board").show();
                    fillMatchData(data);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if(errorThrown === "Internal Server Error"){
                    alert("Error con el servidor o la base de datos");
                }

                if(jqXHR.responseText.indexOf("NO_DATA") > 1){
                    alert("No hay registros de partidas anteriores. Crea un nuevo juego");
                }
            }
        });
    }

    function getMatchScore() {
        $.ajax({
            type: "GET",
            url: "php/getScore.php",
            dataType: 'json',
            success: function (data) {
                if(data.length !== 0){
                    $("#scores").empty();

                    var content = "<table class='table'><tr>";
                    var header = ["Jugador", "Fecha de victoria"];

                    for (let i=0; i<header.length; i++) {
                        content += '<th>' + header[i] + '</th>';
                    }
                    content += "</tr>"

                    for(let i=0; i<data.length; i++){
                        content +='<tr>';
                        content += '<td>' + 'Jugador ' +  data[i].match_winner + '</td>';
                        content += '<td>' + data[i].updated + '</td>';
                        content += '</tr>';
                    }
                    content += "</table>";

                    $("#scores").append(content);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                if(jqXHR.responseText.indexOf("NO_DATA") > 1){
                    alert("No hay puntuaciones registradas");
                }
            }
        });
    }

    function getConfig() {
        $.ajax({
            type: "GET",
            url: "php/getConfig.php",
            dataType: 'json',
            success: function (data) {
                if(data.length !== 0){
                    changeBorderColor(data.colour);
                }
            },
            error: function (jqXHR) {
                if(jqXHR.responseText.indexOf("NO_DATA") > 1){
                    alert("No hay data");
                }
            }
        });
    }

    function newGame() {
        $.ajax({
            type: "POST",
            url: "php/newGame.php",
            dataType: ' json',
            data: $("form").serialize(),
            success: function (data) {
                if(data != null){
                    fillMatchData(data);
                }else {
                    alert("ERROR!")
                }
            },
            error: function (jqXHR) {
                if(jqXHR.responseText.indexOf("ERROR_CREATING") > 1){
                    alert("Error al crear la partida");
                }
            }
        });
    }

    function updateGame() {
        $.ajax({
            type: "POST",
            url: "php/updateMatch.php",
            dataType: ' json',
            data: $("form").serialize(),
            success: function (data) {
                if(data != null){
                    fillMatchData(data);
                }else {
                    alert("ERROR!")
                }

            },
            error: function (jqXHR) {
                if(jqXHR.responseText.indexOf("ERROR_UPDATING") > 1){
                    alert("Error al actualizar partida");
                }
            }
        });
    }

    function clearBoard() {
        $("#winner_div").hide();
        $("#winner_img").hide();
        $("#tie_img").hide();
        $("#winner_h").text("N");

        $("#p_a1").text("");
        $("#p_b1").text("");
        $("#p_c1").text("");
        $("#p_a2").text("");
        $("#p_b2").text("");
        $("#p_c2").text("");
        $("#p_a3").text("");
        $("#p_b3").text("");
        $("#p_c3").text("");
        $("#current_player").text("X");
        $("#current_round").text("1");

        $('input[name="a1"]').val('');
        $('input[name="b1"]').val('');
        $('input[name="c1"]').val('');
        $('input[name="a2"]').val('');
        $('input[name="b2"]').val('');
        $('input[name="c2"]').val('');
        $('input[name="a3"]').val('');
        $('input[name="b3"]').val('');
        $('input[name="c3"]').val('');
        $('input[name="match_round"]').val(1);
        $('input[name="match_status"]').val("IN_PROGRESS");
        $('input[name="match_winner"]').val("N");
        $('input[name="current_player"]').val("X");
    }

    $("#color-game").on('click', function () {
        var colour = $("#colour").val();
        $.ajax({
            type: "POST",
            url: "php/updateConfig.php",
            dataType: ' json',
            data: {'colour':colour},
            success: function (data) {
                if(data != null){
                   changeBorderColor(data.colour);
                }
            },
            error: function (error) {

                alert("Error actualizando el color del tablero");
            }
        });

    });

    function changeBorderColor($colour) {
        var table = document.getElementById("game_table").getElementsByTagName("td");

        for(var i=0; i<table.length; i++) {
            var td = table[i];
            td.style.borderColor = $colour;
        }
    }

    $(function () {
        $('#color-picker-component').colorpicker();
    });
});