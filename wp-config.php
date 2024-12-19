<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '3W3DJ!hk+mhuqNjh#9*f6$JM4%SnZA`g9w U0eMW`cmmFz2`$^mcZeO[@)W.Mp:]' );
define( 'SECURE_AUTH_KEY',  'L]JZxo&|cf3^[TlVHuY[c.uHCgt;-Ci5W}D5Pd13UYxGm7A-M<NtaoM=s$>)~gt1' );
define( 'LOGGED_IN_KEY',    'rLq?yi6%S,3|Wy(c]+>:9919aL?d5k$z/&8/$VBr*n%<~a}<E2)l]y} vl_,k5d0' );
define( 'NONCE_KEY',        'T+pZ5BhyMtsU:C{@-p*7)*3Xab<}!b)U(= N[f]!`&vk$$;/fmO8Q.e3`%4OQR7;' );
define( 'AUTH_SALT',        'szHkpE6_,#wh^;f?2a)h}!nFjdqfq+<$y%+WE*b_9SO^@2FMi~P`kBdi:4. pDTQ' );
define( 'SECURE_AUTH_SALT', '~^`XhsK{luEp}zP5O5KP@_uS(NRkJ^=KA:ZrR(hyWfJ%X5fDvWkx^Ar&44-$V}19' );
define( 'LOGGED_IN_SALT',   '[cl+3&NUA8LlDnw]z~7<rO`mSXq+/1<WZUO$WGf+1hUDi4~U_IX_Dc{Izkx8Df<:' );
define( 'NONCE_SALT',       '_[}}1f%CND{2^2^kUJbLw0; H53kmYs~gyW]d&K`P,iajvK}602Jd_$XJral<+~|' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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
