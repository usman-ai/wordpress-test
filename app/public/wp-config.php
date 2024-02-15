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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',          '=pHODg!~+rqvfs3`)Kldq1YZc@l1UtMxZRvhBF^#(%jgpHEvbU@apJ`%L+%(BGh<' );
define( 'SECURE_AUTH_KEY',   'kc^(DRwB|DO_r80U:*Tj46M)*W=<T(wgw3)ARW?1AWY@@EA1ePe*mnKeu%|u)j_o' );
define( 'LOGGED_IN_KEY',     '2]v.#z|e*:)#Mo=3Tjnr|A.hYs 5$}1C2>NoPPJ==Q?U56}W6yU~L#n=KjL+KLF5' );
define( 'NONCE_KEY',         'VGB}_-LyijH3j;Us^y7sv{n9C}zKrM>}z7#wti3=f&,}/%&4vwOe(;N.Z*2$b@MV' );
define( 'AUTH_SALT',         'ed[zliymW8>6}vN$PQwD<%kv,|yXnnwdb$Fc9Zn. Ys2jeSe}3AmoH!oFf&MU&j[' );
define( 'SECURE_AUTH_SALT',  'oPnsi[4pPT&`%+5s{r-S M/Ew45VkVJtW@[2B-5b/j?c7)m]=okp|%NJg$8paW8J' );
define( 'LOGGED_IN_SALT',    'XCG-89pB.04p?[V::c|uXVaoO6}Auj]7*^})#?5(1gaMTM&SNHFO%Ol<{U|I.I9/' );
define( 'NONCE_SALT',        'S<G^S$;bJ|l4QlTV|c[8]4#!x|$e;tE_D`SSN3~vSs76,S@%i2D(yF$W7x[qsVz6' );
define( 'WP_CACHE_KEY_SALT', '~V <>TQ7oAx_XPo-.mQk~P<*k:v>$JP[+I4t1yK]@JVCc9EV=podQ?;_xoEYNF1!' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
