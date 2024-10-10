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
define('DB_NAME', 'wordpress');

/** Database username */
define('DB_USER', 'wordpress');

/** Database password */
define('DB_PASSWORD', '@12345pass');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         '!_A] sZiQJh)^+K5grUi$ ;9-&wf}.!FDaEMJHZ7}+M10J9T($btdmjE(%X;KU~D');
define('SECURE_AUTH_KEY',  'TvkV]9)Y1Q3@ZKmV&+u`^mX>O|eMLaOUV;Mb@#()ggcSr{|$NNMXq`)=@dd2;9Nu');
define('LOGGED_IN_KEY',    '*w4@OF:5Qs*n]h.ihyB13i.gfZ 40-:bj.>-@a]|DNd;#-&:*[`MgR%-cz0$*|>s');
define('NONCE_KEY',        'p_woP;p9Jq@yg&^{ 2qT|w#h=*w$k^.;G-Wzr-)&ib;-9^gr]i/A:mL96Qm]^[<i');
define('AUTH_SALT',        '2DuaO/X)dKs%l~H BLc)V)$*I~2LzL;[%n|r9M$+K+$(v6mNOML%EM#(4rj3u(dW');
define('SECURE_AUTH_SALT', '4`GQnh N,t9k(uc3/`a/XNr%Z4WcI=bT~*kxMY?|)B63x3J?t^gkF~-4/ms(Vc6L');
define('LOGGED_IN_SALT',   'K7m[%vu?JgU;-J8f$&G)x-Qw2iA^zE[ V[dVyyO%QQ{@q-OBCMmG;ULW}?1BUal^');
define('NONCE_SALT',       'ogq[+K+5X)%J<H3.YIG +%IeRKFBGOk#?4(2=I[}3^~jzc&8T5vzcNPa+c;*Qf#]');

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);


/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
	define('ABSPATH', __DIR__ . '/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
