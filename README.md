# Juego de La Vieja

Juego desarrollado en PHP, con una bd mysql, utilizando un stack LAMP (Linux).

# Instalación

- Clonar el proyecto "lavieja" en el directorio correspondiente al Web Server que se esté utilizando.
- Ejecutar el archivo db.sql incluido en el directorio /sql del proyecto.
- En el directorio php/constants.php  se deben establecer los parámetros de la base de datos como : HOST, USER, PASSWORD, DB_NAME. El DB_name ya está establecido  


# Instrucciones de juego

- Dos jugadores participan en el mismo ordenador, alternando turnos.
- Al hacer click en una de las celdas, se asignara X u O, dependiendo del jugador en turno.
- El primero en completar 3 figuras seguidas ya sea en: horizontal, vertical o diagonal, gana.


# Características adicionales

- Al iniciar la partida se lleva un registro de turno de los jugadores.
- Se tiene una tabla con los últimos 5 ganadores del juego, que se actualiza a medida que se jueguen más partidas.
- Se puede configurar el color del tablero.
- En caso de haber un ganador o un empate se mostrará un mensaje e imagen distinta según sea el caso.