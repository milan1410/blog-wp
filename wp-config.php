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
define( 'DB_NAME', 'wordpress_db' );

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
define( 'AUTH_KEY',         'G:AhxjvjXXDg-~Rk=)]n,gE~G(9ft)6,j}I]L_n:#S=)ix{#C`/>QLSNznwYMY,}' );
define( 'SECURE_AUTH_KEY',  'SojosEWoG6G+oZ<<KiYPSQ2ijk#XDqaa8d5&3!5ap$,zNVyW/u+pqN|qT:cYeW3%' );
define( 'LOGGED_IN_KEY',    'm<-Em~,>h&(;kvOLJ;ck`#qdj(nB2U&<=BeK$4UEzC6xi0B(Gm-2oC.wzoa8,}H$' );
define( 'NONCE_KEY',        'no!4qw2&VZ3NRS:yua=(2IE!m_5#mmbZ=WiE?Me}MRdZ$dUcYw;HxiqcN+I{|$iM' );
define( 'AUTH_SALT',        'u>o<U,NWGg!*1/8~S9R96[-YI/P^V%a$fv(lng0C4y#$82^pEF|Na~Hq]iNY|_14' );
define( 'SECURE_AUTH_SALT', '|T {Q?;8Ly+W}p>pH7|Lv@+dn|AKf)b:an3/23%Bi1@~b;gx`65?$<&+J{#t.#sM' );
define( 'LOGGED_IN_SALT',   '76,&,]OQ}Qsum[Iwj:pY7=E%7VtOw<p!b@ow +Y.bYiN*;3<y5O~*@0FPSr$Bm,z' );
define( 'NONCE_SALT',       'p@(jW~vkY`+4w[*<Do6Tx`vxeG}V0;oR>k1&8gLae69O<af(iUihWK~_51{&b;/K' );

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
