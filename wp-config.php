<?php
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
define('WPCACHEHOME','/home/ubuntu/webapps/devApps/wp-content/plugins/wp-super-cache/');
define('WP_CACHE', true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'devApps');

/** MySQL database username */
define('DB_USER', 'bestviews');

/** MySQL database password */
define('DB_PASSWORD', 'bestxy123');

/** MySQL hostname */
define('DB_HOST', 'bestviews.cspacyaan8uj.us-west-2.rds.amazonaws.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '` <VEVm^lC:MU;o{I,%y#7,Szm})/|6;;;NSfoVp@BgHpibci;;Z<Mm V$t}.+nz');
define('SECURE_AUTH_KEY',  '$DUQ:y0pVdx];6*3c<G|.?N`xM6%3EUs]p%l$n%d{{oz_:9DyK yA5:768W2R^m6');
define('LOGGED_IN_KEY',    '3*#QQe^&Vjs^Df8JBZ?laiA`ag8H-BfI62[O#ZBWsajK;Pp1ZE,0/,v_0h1%-aYb');
define('NONCE_KEY',        'MC,h J=DJV(c]QXs #a(75fC$COC&t>*PMPiY4 NUZEEWaP7s$n*)U`;bYJ-Sm|W');
define('AUTH_SALT',        '3%o6t2w`z7.h4!x-e.)~=n.M5g9|1(n9Yh9yW3UI>XLy #0MlS8Cv9Q0#0[:C+dO');
define('SECURE_AUTH_SALT', 'Y)H1cO-7;!B+o0R(>jpcC$qN!h|HZ4WxceF,t?~MgI4mZSe>j3tzFl:R^OY9?(-=');
define('LOGGED_IN_SALT',   ',NeLq*o!HJckq=cfj.S}sXps-o21{S(Vyveeg-tjxf(t8@.?K6GREyEG&-&F1|5>');
define('NONCE_SALT',       '9}Ffii:b,O;-itR%V; Q;)9kZxoJL&#/={<n+=BF~jbo08B`5A]w[]:KjiSL1p;;');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

