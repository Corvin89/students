<?php
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'student');

/** Имя пользователя MySQL */
define('DB_USER', 'admin');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'admin');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'M<81~7_=_QmdN5/pG&:lJwfC8(#zNB!&tnESuQ1w&v@H5GdPcZ81P.u:}U5Q_qIn');
define('SECURE_AUTH_KEY',  ' D9(Lj_:l$/&!sc3Xg~VQNY3|$<op,{%:}[%qRQbfz]RzR5LQ$=SC??$/#;qf@[E');
define('LOGGED_IN_KEY',    '[~(W%.*Mh8fa5]aJbRUL9-hzj*hD~fhon;=ze/R:)<X`@o}9AkM26=Cn+t-c^~9;');
define('NONCE_KEY',        '1ixDP[+oh|Q_ottFgv812Bs;mn?S3zXLSzd%$Wp>.u}Sv(u?`8Rc--,-Xd~J0;Cu');
define('AUTH_SALT',        '9E`XtZ?KTHMGP$C5U**`UDM%J}bd!Pv*Kfy=OU+)XSxvVx_j1H1!QPYKaB;;SvXN');
define('SECURE_AUTH_SALT', ',:0*~of:mI/+,y&on:CCR8mr>;FA#pWK;3u;`h|w62(?8I(i9wWASE y/@U^o yc');
define('LOGGED_IN_SALT',   '?7r_^LdfrM7jS{95lP*VCu4b8xH,-FKqn)6uj|v*zRQ4T&aaC>Rw;=7P*L~B$=ax');
define('NONCE_SALT',       '/y-Jt8<.T=$1cpJY0~@7&WD6NCKeg>aygX~E4JXg/v:-tkyuPN[VFD DXKebi2ZG');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * Измените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
