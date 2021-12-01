<?php
define( 'WP_CACHE', true );
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'car_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'kbCe4gEO<_p7E:IO.EsR$X<cF+}x 9YIr;Wm!P>>wRC=L%f|pA$Z jTTC`GexS?j' );
define( 'SECURE_AUTH_KEY',  'j]yU@Igpgs0[( rJ>;H!ic=Sr]v_JI(?)lx-U26h`46?j-N~{Iiv[7.+t[AJm=O[' );
define( 'LOGGED_IN_KEY',    'UhhqnKoJPokp2@`WjpL)Bd`W%5HVm&(Cighg4LfFCb8Nj6W7N9kAoYc4g`-p;9>O' );
define( 'NONCE_KEY',        'dzeL_^lRjF{Y_0:#]P;in,1rSsD)F!;|c,zq}B3oqOirCHYZZpZ{cy4INH-PzJ]-' );
define( 'AUTH_SALT',        'SX0KA{UP@k%:^M@[GFuT4CB0@7C<pL)$dAe6bLDR$q{#?|<9K|95i=(ARzs`|GO-' );
define( 'SECURE_AUTH_SALT', '1(9M@;{mlZVdKb~:9buY>I)ni52np:)dwF-4^U6/0<,&;Po K:6Vg$(tjyTH+HHs' );
define( 'LOGGED_IN_SALT',   'UT1I~q35H/J!Y9s7(1`1J_[95BPJb&TL5oM(.YnzLv=.tmjy?bi`#U}I~$%G?6,Y' );
define( 'NONCE_SALT',       ' ~*Z1OKU#;7c^VaI(p)2F{DhqQD}}:1bix*sb.LAoIc&)jpX@<iN%KH;Syk`m3~?' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
