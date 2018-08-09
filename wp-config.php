<?php

/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// Include local configuration
if (file_exists(dirname(__FILE__) . '/local-config.php')) {
	include(dirname(__FILE__) . '/local-config.php');
}

// Global DB config
if (!defined('DB_NAME')) {
	define('DB_NAME', 'dimitris750122_typical');
}
if (!defined('DB_USER')) {
	define('DB_USER', 'dimit_tpcal');
}
if (!defined('DB_PASSWORD')) {
	define('DB_PASSWORD', '9Hat~2h2Zuos6_12');
}
if (!defined('DB_HOST')) {
	define('DB_HOST', 'db51.grserver.gr');
}

/** Database Charset to use in creating database tables. */
if (!defined('DB_CHARSET')) {
	define('DB_CHARSET', 'utf8');
}

/** The Database Collate type. Don't change this if in doubt. */
if (!defined('DB_COLLATE')) {
	define('DB_COLLATE', '');
}

if (!defined('WP_DEBUG')) {
	define('WP_DEBUG', true);
	define('WP_DEBUG_LOG', true);
	define('WP_DEBUG_DISPLAY', true);
}

if (!defined('WP_MEMORY_LIMIT')) {
	define( 'WP_MEMORY_LIMIT', '192M' );
}

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '*YcK?#%_6iW~01Gf)/=,,KNKO{ia`9SV^h^7=dn- .X}:~+qX<[s1 *eU+ZUioC3');
define('SECURE_AUTH_KEY',  '/34I{][FG13daD||df{Rj+P}.D;RHNrRWG 8B2#x95&~(fNuD:{ohr?3O;Kh^yWY');
define('LOGGED_IN_KEY',    'sa#uxI[*X1>)8m:F*M;3A,?8]!MX7|JCd9{/rXhUtH9N2,|GOYSCk5x5,Mrj|00j');
define('NONCE_KEY',        '*9RzR:c,)[4y2@<:{/tCWJ/;#P]-wKlq#+++~)Fh2Siw$5fsf8_,J+V3p$Xj+s6X');
define('AUTH_SALT',        'IP;fGgP9W!&SER:#mP|5SSalYVA*Z5wlRW~7vJ+mpSlQm 9Pj>EBA?0VN@!SPZmx');
define('SECURE_AUTH_SALT', '_~HnautvSffI6>Z|dVw|8C3^09/$8Yx+o$-@@n{=KZY#U/R;U_u>[B9O|g};[vNd');
define('LOGGED_IN_SALT',   '6M.5Zq$r(G:m,+?agSk+b5?-+?R|RXMz-1/&s-}`CRK/n9m., Lp-RfT3**^[4wG');
define('NONCE_SALT',       'G[SRF%8{p<htRHJh^`^w*Ru!K5~t8br`)Af3vv<sh(9(FXfSG0QCm4pW$]HT*U)n');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'typ_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');


/**
 * Set custom paths
 *
 * These are required because wordpress is installed in a subdirectory.
 */
if (!defined('WP_SITEURL')) {
	define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/admin');
}
if (!defined('WP_HOME')) {
	define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME'] . '');
}
if (!defined('WP_CONTENT_DIR')) {
	define('WP_CONTENT_DIR', dirname(__FILE__) . '/app');
}
if (!defined('WP_CONTENT_URL')) {
	define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/app');
}
// if (!defined('COOKIE_DOMAIN')) {
// 	define('COOKIE_DOMAIN', $_SERVER['SERVER_NAME']);
// }

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
