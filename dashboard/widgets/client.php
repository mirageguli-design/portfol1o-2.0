<?php
/**
 * Панель для клиентов.
 *
 * @var WP_User $args['user']
 * @var string  $args['user_role']
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$user      = $args['user'] ?? wp_get_current_user();
$user_name = $user instanceof WP_User ? $user->display_name : '';

$projects = [
	[
		'name'      => 'Digital Start',
		'stage'     => __( 'Аналитика и гипотезы', 'consult-dashboard' ),
		'progress'  => 65,
		'owner'     => 'Анна Карпова',
		'next_step' => __( 'Отправить обратную связь по исследованию', 'consult-dashboard' ),
	],
	[
		'name'      => 'HR 2.0',
		'stage'     => __( 'Внедрение рекомендаций', 'consult-dashboard' ),
		'progress'  => 82,
		'owner'     => 'Пётр Власов',
		'next_step' => __( 'Согласовать план обучения руководителей', 'consult-dashboard' ),
	],
];

$documents = [
	[
		'title' => __( 'Финальный отчёт по HR-аудиту', 'consult-dashboard' ),
		'type'  => __( 'PDF, 28 страниц', 'consult-dashboard' ),
		'link'  => home_url( '/client/documents/hr-final-report/' ),
	],
	[
		'title' => __( 'Материалы стратегической сессии', 'consult-dashboard' ),
		'type'  => __( 'Презентация', 'consult-dashboard' ),
		'link'  => home_url( '/client/documents/strategy-session/' ),
	],
];

$support = [
	[
		'title' => __( 'Назначить консультацию', 'consult-dashboard' ),
		'description' => __( 'Выберите удобное время и тему консультации', 'consult-dashboard' ),
		'link' => home_url( '/client/booking/' ),
	],
	[
		'title' => __( 'Написать менеджеру', 'consult-dashboard' ),
		'description' => __( 'Свяжитесь с куратором проекта напрямую', 'consult-dashboard' ),
		'link' => wp_login_url(),
	],
];
?>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'Ваши проекты', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Актуальные статусы и ответственные', 'consult-dashboard' ); ?></p>
	</header>

	<table class="consult-dashboard-table">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Проект', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Этап', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Прогресс', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Куратор', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Следующее действие', 'consult-dashboard' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $projects as $project ) : ?>
				<tr>
					<td><?php echo esc_html( $project['name'] ); ?></td>
					<td><?php echo esc_html( $project['stage'] ); ?></td>
					<td>
						<strong><?php echo esc_html( $project['progress'] ); ?>%</strong>
						<div class="consult-dashboard-progress">
							<span style="width: <?php echo esc_attr( $project['progress'] ); ?>%;"></span>
						</div>
					</td>
					<td><?php echo esc_html( $project['owner'] ); ?></td>
					<td><?php echo esc_html( $project['next_step'] ); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'Документы и материалы', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Скачайте подготовленные для вас материалы', 'consult-dashboard' ); ?></p>
	</header>

	<div class="consult-dashboard__grid">
		<?php foreach ( $documents as $document ) : ?>
			<article class="consult-dashboard-card consult-dashboard-card--document">
				<h3 class="consult-dashboard-card__title"><?php echo esc_html( $document['title'] ); ?></h3>
				<p><?php echo esc_html( $document['type'] ); ?></p>
				<a class="consult-dashboard__cta-link" href="<?php echo esc_url( $document['link'] ); ?>">
					<?php esc_html_e( 'Скачать', 'consult-dashboard' ); ?>
				</a>
			</article>
		<?php endforeach; ?>
	</div>
</section>

<section class="consult-dashboard__cta">
	<?php foreach ( $support as $item ) : ?>
		<article class="consult-dashboard__cta-card">
			<h3><?php echo esc_html( $item['title'] ); ?></h3>
			<p><?php echo esc_html( $item['description'] ); ?></p>
			<a href="<?php echo esc_url( $item['link'] ); ?>">
				<?php esc_html_e( 'Перейти', 'consult-dashboard' ); ?>
			</a>
		</article>
	<?php endforeach; ?>
</section>

