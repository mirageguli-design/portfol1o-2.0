<?php
/**
 * Панель для экспертов.
 *
 * @var WP_User $args['user']
 * @var string  $args['user_role']
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$user      = $args['user'] ?? wp_get_current_user();
$user_name = $user instanceof WP_User ? $user->display_name : '';

$upcoming_sessions = [
	[
		'topic'     => __( 'Консультация по операционной эффективности', 'consult-dashboard' ),
		'client'    => 'АО «Север-Инвест»',
		'datetime'  => __( '11 ноября · 10:00–11:30', 'consult-dashboard' ),
		'format'    => __( 'Онлайн (Zoom)', 'consult-dashboard' ),
	],
	[
		'topic'     => __( 'Диагностика HR-процессов', 'consult-dashboard' ),
		'client'    => 'ООО «Статус Групп»',
		'datetime'  => __( '12 ноября · 14:00–16:00', 'consult-dashboard' ),
		'format'    => __( 'Офис клиента', 'consult-dashboard' ),
	],
];

$knowledge_base = [
	[
		'title' => __( 'Шаблон дорожной карты внедрения изменений', 'consult-dashboard' ),
		'link'  => home_url( '/knowledge/change-roadmap/' ),
		'type'  => __( 'Документ', 'consult-dashboard' ),
	],
	[
		'title' => __( 'Чек-лист подготовки к стратегической сессии', 'consult-dashboard' ),
		'link'  => home_url( '/knowledge/strategy-session-checklist/' ),
		'type'  => __( 'PDF', 'consult-dashboard' ),
	],
	[
		'title' => __( 'База вопросов для интервью с топ-менеджерами', 'consult-dashboard' ),
		'link'  => home_url( '/knowledge/interview-questions/' ),
		'type'  => __( 'Google Docs', 'consult-dashboard' ),
	],
];

$feedback = [
	[
		'project' => 'Digital Start',
		'rating'  => 4.8,
		'comment' => __( 'Отличная структура консультации, ценность — с первых минут.', 'consult-dashboard' ),
		'client'  => __( 'Руководитель по развитию, ООО «Digital Start»', 'consult-dashboard' ),
	],
	[
		'project' => 'HR 2.0',
		'rating'  => 4.6,
		'comment' => __( 'Получили понятный план и поддержку по внедрению. Спасибо!', 'consult-dashboard' ),
		'client'  => __( 'HR-директор, АО «HR 2.0»', 'consult-dashboard' ),
	],
];
?>

<section class="consult-dashboard__grid">
	<?php foreach ( $upcoming_sessions as $session ) : ?>
		<article class="consult-dashboard-card">
			<h2 class="consult-dashboard-card__title"><?php echo esc_html( $session['topic'] ); ?></h2>
			<p><strong><?php esc_html_e( 'Клиент', 'consult-dashboard' ); ?>:</strong> <?php echo esc_html( $session['client'] ); ?></p>
			<p><strong><?php esc_html_e( 'Дата и время', 'consult-dashboard' ); ?>:</strong> <?php echo esc_html( $session['datetime'] ); ?></p>
			<p><strong><?php esc_html_e( 'Формат', 'consult-dashboard' ); ?>:</strong> <?php echo esc_html( $session['format'] ); ?></p>
			<div class="consult-dashboard-empty__actions">
				<a href="<?php echo esc_url( add_query_arg( 'session', sanitize_title( $session['topic'] ), home_url( '/expert/sessions/' ) ) ); ?>">
					<?php esc_html_e( 'Открыть бриф', 'consult-dashboard' ); ?>
				</a>
				<a class="consult-dashboard__cta-link" href="<?php echo esc_url( home_url( '/expert/report/' ) ); ?>">
					<?php esc_html_e( 'Отправить итоги', 'consult-dashboard' ); ?>
				</a>
			</div>
		</article>
	<?php endforeach; ?>
</section>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'База знаний', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Актуальные материалы и шаблоны для консультаций', 'consult-dashboard' ); ?></p>
	</header>

	<div class="consult-dashboard__grid">
		<?php foreach ( $knowledge_base as $item ) : ?>
			<article class="consult-dashboard-card consult-dashboard-card--knowledge">
				<h3 class="consult-dashboard-card__title"><?php echo esc_html( $item['title'] ); ?></h3>
				<p><?php echo esc_html( $item['type'] ); ?></p>
				<a class="consult-dashboard__cta-link" href="<?php echo esc_url( $item['link'] ); ?>">
					<?php esc_html_e( 'Скачать / открыть', 'consult-dashboard' ); ?>
				</a>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'Обратная связь от клиентов', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Средняя оценка и комментарии', 'consult-dashboard' ); ?></p>
	</header>

	<ul class="consult-dashboard-timeline">
		<?php foreach ( $feedback as $item ) : ?>
			<li class="consult-dashboard-timeline__item">
				<h3 class="consult-dashboard-timeline__title">
					<span><?php echo esc_html( $item['project'] ); ?></span> · <strong><?php echo esc_html( $item['rating'] ); ?>/5</strong>
				</h3>
				<p class="consult-dashboard-timeline__meta">
					<?php echo esc_html( $item['comment'] ); ?> — <?php echo esc_html( $item['client'] ); ?>
				</p>
			</li>
		<?php endforeach; ?>
	</ul>
</section>

