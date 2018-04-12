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
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'eNspmvJ0s;/4ZcpEfNh-OtMhm4+.+sFcM|CMQ));B@V45v.0qPX^M><zYv/1trbM');
define('SECURE_AUTH_KEY',  '7nhn)rO-nT$`?>%fWe`VSQ[!ba4 VO_G$1ASB/En%VPQ[Vrw<~8P.`WIBLKN>t_%');
define('LOGGED_IN_KEY',    'fN:41:l<yt~nQP)2XgX[}PV}db$sh4}TT>nK%09pqaCm{X5}Mu;fm,=4[9>+mwxo');
define('NONCE_KEY',        'raXB%lpC9*`>`}`<1uiTOqt9k9PW!.=oJ5_Xb(Tx;.?VQ(M~EEi$8e!+r;]!r-Yh');
define('AUTH_SALT',        'p$Y_Y^}(LWz.Kh*9Y0#_iu@JWtJW~PU~:V[ib-pqf$LL:5@hHRdc|OF`G51I]fdS');
define('SECURE_AUTH_SALT', 'P1PCT@oPe/|[lK3 $I-Yr>eoj,^E@&(}CV+T24nMdr8R1/YNQ[Q1(rMqlFxDn<Ud');
define('LOGGED_IN_SALT',   'U7@0VDL)LL%;T+)SWHS%PlB|^]XYzf|+_J$fOs.$5%D5-n36fJ)Kmo3NCjZ.)NO)');
define('NONCE_SALT',       'kA!gCv}4 D!0VlbaLJx*l0x>,(if-9WE>joJ;S.P0J3W ~WY#%ED|K!9th*f#Dn:');

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
