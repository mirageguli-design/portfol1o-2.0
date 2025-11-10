<?php
/**
 * Панель для гостей (неавторизованные / без специфической роли).
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<section class="consult-dashboard-empty">
	<div class="consult-dashboard-empty__icon" aria-hidden="true">👋</div>
	<h2 class="consult-dashboard-empty__title"><?php esc_html_e( 'Добро пожаловать!', 'consult-dashboard' ); ?></h2>
	<p class="consult-dashboard-empty__text">
		<?php esc_html_e( 'Чтобы получить доступ к персональной аналитике и проектам, пожалуйста, дождитесь подтверждения роли или обратитесь к администратору.', 'consult-dashboard' ); ?>
	</p>

	<div class="consult-dashboard-empty__actions">
		<a href="<?php echo esc_url( home_url( '/contacts/' ) ); ?>">
			<?php esc_html_e( 'Связаться с администрацией', 'consult-dashboard' ); ?>
		</a>
		<a href="<?php echo esc_url( home_url( '/services/' ) ); ?>">
			<?php esc_html_e( 'Посмотреть услуги', 'consult-dashboard' ); ?>
		</a>
	</div>
</section>

