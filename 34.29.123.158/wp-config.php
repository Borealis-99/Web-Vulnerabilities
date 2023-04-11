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
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'board' );

/** Database username */
define( 'DB_USER', 'ctf2023board' );

/** Database password */
define( 'DB_PASSWORD', 'WeLoveToParty' );

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
define( 'AUTH_KEY',         'O?K/^rjEnF~:Kr>bRUPg;pkHS:._md]*N[P>FiXWMuYaT~C>Efkkp2j!y)2sa6::' );
define( 'SECURE_AUTH_KEY',  'mewIHCi.!K9OZ/^81 HNRQdgf>/{A99[V%(^0Uw/(]XOMY~9{!n0,-k@JKRy,p*T' );
define( 'LOGGED_IN_KEY',    'uM:H`Q5Q&GqL-oG1tsHL6Vo,#T&S&24jY3FIda:HU&|>B>,N@5+G0>%110k;yWH&' );
define( 'NONCE_KEY',        '{G)5YID55-@a1]DA!xsE.9{:~+g,?a%ABGzmT1#XWq!GBBtO:~&tA&|D<TFn>t8M' );
define( 'AUTH_SALT',        'h62Iq<b!$`|&v/+#yp48FQnKpdJ/;>:Ks78iQHE}FFG6]oQ7YymBmi~#yT.HYNG>' );
define( 'SECURE_AUTH_SALT', '+-,9rNj^8!pyr<o+r2~09!HmpqO1Zt;:VHRg!~I]7=oh;L6*$)Vb?s)>CH9m0QT~' );
define( 'LOGGED_IN_SALT',   ']f}_+x=J:6N8BPqU@NB7h:RUk2KfZ#o@#2*:pucm/X<T_pp&4[{x,X*lV`/NCIWA' );
define( 'NONCE_SALT',       '$tsBSsvI(])a&9C>/n#ipp@f@EtNh1,9RC;RT-}/ {ka(g$!A2ipA&qu/q~e8^%{' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
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

