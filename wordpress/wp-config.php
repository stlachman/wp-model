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
define('DB_NAME', 'wordpresstest');
/** MySQL database username */
define('DB_USER', 'root');
/** MySQL database password */
define('DB_PASSWORD', 'root');
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
define('AUTH_KEY',         'UqqDi/9H52Oi[uJ)m&[EyiUJKkc{LHd{|_q5`mv5CDG%:LZ-^GQ]B9TG}`m|w>wt');
define('SECURE_AUTH_KEY',  '!rU>)yH^|VtXTNbp1Rv|@OJ&LtTxFtirOqc:V),A!%Vd`HE;WTW#jmlcVaSBamvn');
define('LOGGED_IN_KEY',    'AB+~]]w9:0[p^L#y*Qox!uy#I,]<*0>aU$x$nH*]UNq9XbT)81ok<>+((N~y%ym:');
define('NONCE_KEY',        'l&gR7=lG2~eAR~(w]oEewXW;TVMR73P?pE,kSU<Q3==H,Z^@%@y/iq[sTm,CWw*-');
define('AUTH_SALT',        '~t<p_U&MAC|i:09ewo~sV@TVT`B@mJ,fT2OrwrWj97c|0tjP:pQ_/?@~apc<pimG');
define('SECURE_AUTH_SALT', '~Za;:e({yUlQj1:n<Oc6APXM<uR2V8Mj*2[+761>-Wlxp3HSxoP9EB%QdZH?ii;_');
define('LOGGED_IN_SALT',   ':xkjzcZY;P6+;_cR,-dRJ|L 3j]N_:E#>q{/WQJHUJ{<bzUo&CK,/Pk]Y?f-mn^8');
define('NONCE_SALT',       'VRvEv3/Jkq;UA-p[%R-URM{PJP*ZixS<[!H_L&UW<U@;4 qQO+yImlW5Y=_X6nPC');
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
