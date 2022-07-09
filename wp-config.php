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
define( 'DB_NAME', 'corporalexperience' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',         'cP2e+}g<Gd>>P`=3b_Zw%-3>MP-};=YyN}d%+4DN/~tASnt/~y4:k71.x+T/tl^`' );
define( 'SECURE_AUTH_KEY',  'j%xZhwpV<;k-#Jh2h,,AkVYVMAOz|(0`mv_!Dr~Y7Af:QarT$wwmS%oR;631LYpb' );
define( 'LOGGED_IN_KEY',    'Nqzk{oBn[T%#eyRK2,o)Y&4^f^-oqOoh{8`.UDy!<ftbhG*|N^+z7J_vv|MG0F+[' );
define( 'NONCE_KEY',        'cswuwP#Nfnd;)A|V/CtG~{b5sqTeYM^Ys(jQTa@7j9UW& VGz9K,6m<r3alBKWx2' );
define( 'AUTH_SALT',        ' fDm4>j/wXx*jPv%p E@xJlNRsYl8TNq%OaE>?MSEZ0LDGT8.gJx_R0WJ@]3B]cW' );
define( 'SECURE_AUTH_SALT', 'hH,zOSt wAL4pUKpmX<qH*Vv?6IUP8Z$FA(.),*yaY%Sy$a`q:6+IPf8VawKtj[y' );
define( 'LOGGED_IN_SALT',   'G;Jw IrH,LyLP<%<l):MUS6S%A4pwb;ZS`8n]s<V4[xxZN w5iQN<yCG%h-|u1=I' );
define( 'NONCE_SALT',       ']8D2U5iZYb{rPIUII2]sk>3qEa{?FX*}f$hu&o{$kPK,+Ju9Wcymkoq+QtriW,zg' );

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
