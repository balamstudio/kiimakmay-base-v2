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

define('FORCE_SSL_ADMIN', true);
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && 'https' == $_SERVER['HTTP_X_FORWARDED_PROTO'] ) {
    $_SERVER['HTTPS'] = 'on';
}

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'kiimak_base_v2' );

/** Database username */
define( 'DB_USER', 'balam_admin' );

/** Database password */
define( 'DB_PASSWORD', 'Balampassword' );

/** Database hostname */
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
define( 'AUTH_KEY',         'V/FP5Lm~k{48IkaWl&>Zpxa&_VrWysHCpyXR@s<,!I>KFj,rZx52[7#``^+A]dWA' );
define( 'SECURE_AUTH_KEY',  '=7{BfV*]y#Y&E}w9|$B!Z5!n9b[gqVEH5ZNrfEaK )/YF_NjI2eNICk#H4T)LWeO' );
define( 'LOGGED_IN_KEY',    '9T-!t3g?Mj@^KBQ[E/Yh:f)H8KKP?aIyslAUph;,J;6dMu[6Tb++-_x!Cu@hc6)L' );
define( 'NONCE_KEY',        'y:k.YXt2Vq#[~F`WaoFQ6L:mxEPiz-cP/7/.+p PYLxTQ>=_}wXFW4B:((I+M uH' );
define( 'AUTH_SALT',        '#V}%v;QE3D-o9~I*[P}hMZ7>%!]edv~-E<n%;$DB:Vdgo*T{x1QW+ 7J^E})LRT{' );
define( 'SECURE_AUTH_SALT', '7L,+hPJo!e,%*{PMPiA#bd*IQYzzeh9jv5U3L%m7[X&)]1OIe,8%#n}7)XD9`Y:;' );
define( 'LOGGED_IN_SALT',   'N`tBf5s>qq+2UKqY,SiqB_Q|X{cqWBFxA[FPSMH]T>e^nkJV}@{Izq[2(d_cN,7d' );
define( 'NONCE_SALT',       'J%;3(1>?IdH#lVC?A-x=/]9ZEJ4eAx8[Hdii4)M~e9pLRG%fwq1:7lyw:@&P!eG7' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'km_';

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
// define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/* ADDED BY ZONAIT */
ini_set('display_errors','Off');
ini_set('error_reporting', 'E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING' );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);
define('WP_MEMORY_LIMIT', '1024M' );
define('WP_CACHE', true);

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
