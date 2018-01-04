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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'pgsd_db');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', '127.0.0.1');

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
define('AUTH_KEY',         'zd^Xe[Q:!`g3ZYjF0sv:I2@QC72(Tj+LhrE6*Y>EX6B7fqV6+7ZQa{K|0S&cjGZw');
define('SECURE_AUTH_KEY',  '-$B]kT>p?]YaTr.w[o$0.IFwn?Age+u2wV>cJ)q9]s/~;A =`s-hp)qdsjDhx.cX');
define('LOGGED_IN_KEY',    'sZh}MK)jT.)</#^|!_mL )&dZ0T6-PQryQ5Isycf$$vSM.[&$M5Q7}o,RdK;WZ}$');
define('NONCE_KEY',        'g] EEN |}6cpEgsX]9#xO-G/NP77tffXOjFHIdZ6xA[RP9`{r}Fir3NR-`+`KQ%#');
define('AUTH_SALT',        '.a_ih8@<qJT`|zl:@~YVy-hu07`8:)DpaJ[OI}/*^AaqcSBP%[Pb^kVA_opw1$R5');
define('SECURE_AUTH_SALT', 'Nq+qCR=:ly_<.A4v}HCx*v-Y1i7VbT>tlC*tT2^[F7@Iv/~iZt ZjO&*H_SLZ]f<');
define('LOGGED_IN_SALT',   'AQ}x+X* %pn$|#SySRO}&3u^>InWAiIq_;d7zr+Rwki>ZL&F+<txsGZJVjcF1M?b');
define('NONCE_SALT',       '>g8[$nK~+?HcT(3U3>6!vS5r-SQ9bN4>J^xJQ#Mjugt%,4X?.+M,D;ox>rX_huEk');

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
