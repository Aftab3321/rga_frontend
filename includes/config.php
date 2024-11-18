<?php
if (str_contains($_SERVER['SERVER_NAME'],"localhost")) {
  define( 'DB_HOST', 'localhost' );          // Set database host
  define( 'DB_USER', 'root' );             // Set database user
  define( 'DB_PASS', '' );             // Set database password
  define( 'DB_NAME', 'p9ltdc5_rga_database' );        // Set database name
} else {
  define( 'DB_HOST', 'localhost' );          // Set database host
  define( 'DB_USER', 'p9ltdc5_ahmed_aftab' );             // Set database user
  define( 'DB_PASS', 'Xx(Umg5)lMHV' );             // Set database password
  define( 'DB_NAME', 'p9ltdc5_rga_database' );        // Set database name
}

?>