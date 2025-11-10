<?php
/**
 * Template Name: Личный кабинет
 * Description: Персональная панель управления для клиентов консультативного агентства.
 *
 * Зависимости:
 * - Elementor Pro (виджеты и секции в шаблонах меню/виджетов)
 * - WP Recal (шорткод меню: [recal_menu id="main-dashboard-menu"])
 *
 * Права доступа:
 * - Гость (guest)
 * - Администратор (administrator)
 * - Сотрудник (staff)
 * - Эксперт (expert)
 * - Клиент (client)
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! is_user_logged_in() ) {
	wp_redirect( wp_login_url( get_permalink() ) );
	exit;
}

$current_user = wp_get_current_user();
$user_role    = $current_user->roles[0] ?? 'guest';

$available_widgets = [
	'administrator',
	'staff',
	'expert',
	'client',
	'guest',
];

if ( ! in_array( $user_role, $available_widgets, true ) ) {
	$user_role = 'guest';
}

// Подключаем стили/скрипты дашборда.
wp_enqueue_style(
	'consult-dashboard',
	get_template_directory_uri() . '/dashboard/assets/css/dashboard.css',
	[],
	'1.0.0'
);

wp_enqueue_script(
	'consult-dashboard',
	get_template_directory_uri() . '/dashboard/assets/js/dashboard.js',
	[ 'jquery' ],
	'1.0.0',
	true
);

get_header();
?>

<div class="consult-dashboard">
	<aside class="consult-dashboard__sidebar" aria-label="<?php esc_attr_e( 'Боковое меню личного кабинета', 'consult-dashboard' ); ?>">
		<button class="consult-dashboard__sidebar-toggle" type="button" data-toggle="sidebar">
			<span class="consult-dashboard__sidebar-toggle-icon" aria-hidden="true"></span>
			<span class="consult-dashboard__sidebar-toggle-label"><?php esc_html_e( 'Меню', 'consult-dashboard' ); ?></span>
		</button>

		<div class="consult-dashboard__sidebar-inner">
			<?php
			/**
			 * Показываем меню, собранное через WP Recal или Elementor.
			 * Шорткод можно заменить любым другим, если меню управляется иначе.
			 */
			echo do_shortcode( '[recal_menu id="main-dashboard-menu"]' );
			?>
		</div>
	</aside>

	<main class="consult-dashboard__main">
		<header class="consult-dashboard__header">
			<div>
				<h1 class="consult-dashboard__title">
					<?php
					printf(
						/* translators: %s: Пользователь */
						esc_html__( 'Здравствуйте, %s!', 'consult-dashboard' ),
						esc_html( $current_user->display_name )
					);
					?>
				</h1>

				<p class="consult-dashboard__subtitle">
					<?php
					printf(
						/* translators: %s: Текущая роль пользователя */
						esc_html__( 'Ваша роль: %s', 'consult-dashboard' ),
						esc_html( translate_user_role( ucfirst( $user_role ) ) )
					);
					?>
				</p>
			</div>

			<div class="consult-dashboard__profile-card">
				<div class="consult-dashboard__avatar">
					<?php echo get_avatar( $current_user->ID, 80 ); ?>
				</div>

				<ul class="consult-dashboard__profile-meta">
					<li>
						<strong><?php esc_html_e( 'Email', 'consult-dashboard' ); ?>:</strong>
						<a href="mailto:<?php echo esc_attr( $current_user->user_email ); ?>">
							<?php echo esc_html( $current_user->user_email ); ?>
						</a>
					</li>
					<li>
						<strong><?php esc_html_e( 'Дата регистрации', 'consult-dashboard' ); ?>:</strong>
						<?php echo esc_html( date_i18n( get_option( 'date_format' ), strtotime( $current_user->user_registered ) ) ); ?>
					</li>
				</ul>
			</div>
		</header>

		<?php
		/**
		 * Хук перед основной частью дашборда.
		 *
		 * @since 1.0.0
		 */
		do_action( 'consult_dashboard_before_content', $current_user, $user_role );

		get_template_part(
			'dashboard/widgets/' . $user_role,
			null,
			[
				'user'      => $current_user,
				'user_role' => $user_role,
			]
		);

		/**
		 * Хук после основной части дашборда.
		 *
		 * @since 1.0.0
		 */
		do_action( 'consult_dashboard_after_content', $current_user, $user_role );
		?>
	</main>
</div>

<?php get_footer(); ?>

