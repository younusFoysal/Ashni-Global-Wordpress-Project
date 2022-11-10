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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'ashnitst' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ')W>#r{=<O-pdAM(G?p;|j4IBh X,T:(!]TrW,<[=a*Ws-8y@]%1r1?jyw]~gnVEf' );
define( 'SECURE_AUTH_KEY',  'Er:[2S<APjH(WwT_~2%VCx*bO1CZl#9b_^|Ay&N$^<A=kl4tL@kDm!tp!If?E04,' );
define( 'LOGGED_IN_KEY',    '6RPuRN/+PiT~;l*e+rrTeP=u[!)v7fi:o|`}5N?e]OkMg5=,g43O+Lo|+7GNT,w3' );
define( 'NONCE_KEY',        ')=dY@^),C}F~<EJyb#5So$bHMmoK4T>myW.=5DCagK=kof[7h19[m.+PbGNPYQg@' );
define( 'AUTH_SALT',        'JSwrLB((z`Z>fHnw;/[7^bfTW.q0qYxHe(Oa,>h3P1*|~cs&)|z?c=Upd3V}g &W' );
define( 'SECURE_AUTH_SALT', '?A=>d2.N:lJeBM5#wBdi+~*WxhBZY{=$SQeujoh;<c37bU,I`oNz3K/x$/Qm!~h!' );
define( 'LOGGED_IN_SALT',   '{:M2<7(&Ee&AfsI#q1K qI$n=sATIwe NM4a4zNvHMe0=:Uk~}`_7lH!ooa7>*^j' );
define( 'NONCE_SALT',       '9&6.|cXv_EI.)DBa7@8-trk23%(F0/MA(ENmCh*?9b6iFR+I,vbElSgS/ITLpc1%' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
