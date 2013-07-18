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

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'montenegro');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'I7oB)JVIL7|_x,ffOiCZCh2]]<Bey-?aIGxD~8W_4[[B)&C]H)D=T2z[H8aP@yrq');
define('SECURE_AUTH_KEY',  'Ca]$on=MS=n:KLTpk<s~3z&c0ZR:*y+E$sZ>rj@yY>s=|%7_>vB3/Ur^pXcXl~<$');
define('LOGGED_IN_KEY',    ']$NXs@<.&iF,NT.WPF2,S=~ZI4yd+{0#k*3N)X-i/l}%C,Eo{}~Rl{fiqCa85ZB&');
define('NONCE_KEY',        '3W1+u!kcY[sBi$Mb59P{O%@d&3X->Qvn<-cOI{bSz1d5eq^6Led!BZQ~W3ZX-0Q~');
define('AUTH_SALT',        ' @h8/JiOBHK:]H-+!u;=L`H=BW;M9GkaxnQ,Ci2I>+-zsl8nm:0o&GV|A`>asle:');
define('SECURE_AUTH_SALT', 'V-OI`|/,{EOIX%TZ%sT&-S%%;BLElRdHN]!`i?&5ZkyM?e!WSaf(:+F2#Z=xmGNF');
define('LOGGED_IN_SALT',   '`TzT((j(I)`o+/@b%0/H.?S>MW<cWr=GDCn??qan>O$r5nU((v3([!/2@?]Ap{q~');
define('NONCE_SALT',       '?[nxypF0IliVIWu]rPb1OEgM&#nl-d]4Wes2+rB|}#;Q(MuTa9E[jw[w*H#;jqtV');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
