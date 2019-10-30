<?php
define('WP_CACHE', false);
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'gameroks_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'H_>am=7=mf;B+c=7odD_!(krLO:hk-&56^M|ZE6h;% J)5WpJ_9{R+%/mj^*;@HH' );
define( 'SECURE_AUTH_KEY',  '?yt*~&<yn:z>Z<5w)(M=[K(& $I2lK@axwD}+t&+Mt,pvrfe!-PMn#C+~kq&<!|p' );
define( 'LOGGED_IN_KEY',    '|yunJTi`yA]^|)Z<^=^*kt*)RYLecN{Z}oldwm[*$(S0y0h|<gPEW? ;0Q.@me>Z' );
define( 'NONCE_KEY',        '#O^og-;?Iu/S}O)pJ8<QhuZ2I`0!@qrS3{)0uws:fksn9Xxts8OlsfZ[=VkG*rUM' );
define( 'AUTH_SALT',        'X-swgWD/_1GHroUX.8>xt)p%z5^zGvht=YXah$A5&&@M;aRfBe1*zYWLqrOjLoIM' );
define( 'SECURE_AUTH_SALT', '4IYEW!P+f*8U#I=*bU?bqGN: o:W#3qIbEGaE6FW[Yd8;=MM;l~,YBYzoZK^KzVr' );
define( 'LOGGED_IN_SALT',   '`r+S.&8<~:6fjT6M31:<o7Rc{5?R:D.fL/!xxHVZ+&(V;Q!yPOD}.g[}U@TtiY>}' );
define( 'NONCE_SALT',       'r9l#SsWIXHOtCr*+1Rl.*3;tY%EJK-)5vaw@y:7Sd(q-IEl+b|J%c$M`uk8{bd))' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('JETPACK_DEV_DEBUG', true);


/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
