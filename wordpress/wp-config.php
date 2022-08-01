<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** Database username */
define('DB_USER', 'wordpress');

/** Database password */
define('DB_PASSWORD', 'wordpress');

/** Database hostname */
define('DB_HOST', 'database');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY',         'F^F7=~Z0UEL6QL{I+rqw%i%56@8 $ZN?Z$-:9o_O0/_v@OdBde{fFp!P=@:z_`rL');
define('SECURE_AUTH_KEY',  '(O7KD7q6Vad~!A_f~yn>QJgD_3h~dNmUSP]vGM@Fb<b{ggKvCPo&s|^/~YcM~1#u');
define('LOGGED_IN_KEY',    ']%M9o~z<sLqRgMJ5gd5Z2k*G[A:@1`,>RSL9ax<]l!AlzNlWw3!D/]0&0D!yX`l&');
define('NONCE_KEY',        '#pu,`R8OCL.9[@!2rFz~rhoXz8*|ZgvSzeu;tY5ix_ET8;@Ss8A98GTIp>`=mZB%');
define('AUTH_SALT',        'N&m3/QlZbpx[2ddRm|1GMj%+{Sa[.`TQCHw!>7B:Sfon16m0kOeKPf!WA`<n`C`r');
define('SECURE_AUTH_SALT', 'YDt^bUyrA|g{BG/jC|:1G31Cm$GPwfd:r9Sp;KpE~2uJ]@Zg)Fw[IS#u86$eC h1');
define('LOGGED_IN_SALT',   'O/_0Mo,NKxp]Xl$_BZ#DS,G}ls%el,JH`Evq@G2NeP{tJ.%V+~E2sd^*ynfUWp v');
define('NONCE_SALT',       'GD%SZqDwj-XBv*zFnnU&73XIEtig|Klzi053IrTT)HyIK(KydhJd`g]R2K1%P~Z}');

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
define('WP_DEBUG', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (!defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
