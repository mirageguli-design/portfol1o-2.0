<?php
/**
 * Панель для сотрудников (project staff).
 *
 * @var WP_User $args['user']
 * @var string  $args['user_role']
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$user         = $args['user'] ?? wp_get_current_user();
$user_name    = $user instanceof WP_User ? $user->display_name : '';
$current_date = date_i18n( get_option( 'date_format' ) );

$daily_plan = [
	[
		'title' => __( 'Подготовить бриф по проекту «Digital Start»', 'consult-dashboard' ),
		'time'  => __( '09:30', 'consult-dashboard' ),
		'status' => 'success',
	],
	[
		'title' => __( 'Синк с командой проекта HR 2.0', 'consult-dashboard' ),
		'time'  => __( '11:00', 'consult-dashboard' ),
		'status' => 'warning',
	],
	[
		'title' => __( 'Обновить карточку клиента «ТехноПлюс»', 'consult-dashboard' ),
		'time'  => __( '14:00', 'consult-dashboard' ),
		'status' => 'default',
	],
	[
		'title' => __( 'Финализировать презентацию для руководства', 'consult-dashboard' ),
		'time'  => __( '17:30', 'consult-dashboard' ),
		'status' => 'default',
	],
];

$projects = [
	[
		'name' => 'Digital Start',
		'progress' => 72,
		'deadline' => __( '20 ноября', 'consult-dashboard' ),
		'lead' => 'Анна Карпова',
	],
	[
		'name' => 'HR 2.0',
		'progress' => 45,
		'deadline' => __( '5 декабря', 'consult-dashboard' ),
		'lead' => 'Пётр Власов',
	],
	[
		'name' => 'Стратегия роста «Север-Инвест»',
		'progress' => 88,
		'deadline' => __( '28 ноября', 'consult-dashboard' ),
		'lead' => 'Мария Щеглова',
	],
];

$resources = [
	[
		'title' => __( 'Методика Discovery-сессий', 'consult-dashboard' ),
		'description' => __( 'Пошаговая инструкция по проведению сессий с клиентами', 'consult-dashboard' ),
		'link' => home_url( '/knowledge/discovery-guide/' ),
	],
	[
		'title' => __( 'Шаблон отчёта эффективности', 'consult-dashboard' ),
		'description' => __( 'Готовый шаблон Excel для оценки KPI', 'consult-dashboard' ),
		'link' => home_url( '/knowledge/report-template/' ),
	],
];
?>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title">
			<?php
			printf(
				/* translators: %s: Имя пользователя */
				esc_html__( 'Ваш план на %s', 'consult-dashboard' ),
				esc_html( $current_date )
			);
			?>
		</h2>
	</header>

	<ul class="consult-dashboard-timeline">
		<?php foreach ( $daily_plan as $item ) : ?>
			<li class="consult-dashboard-timeline__item">
				<h3 class="consult-dashboard-timeline__title"><?php echo esc_html( $item['title'] ); ?></h3>
				<p class="consult-dashboard-timeline__meta">
					<?php echo esc_html( $item['time'] ); ?>
				</p>
			</li>
		<?php endforeach; ?>
	</ul>
</section>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'Текущие проекты', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Прогресс и ответственные', 'consult-dashboard' ); ?></p>
	</header>

	<table class="consult-dashboard-table">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Проект', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Прогресс', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Дедлайн', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Ответственный', 'consult-dashboard' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $projects as $project ) : ?>
				<tr>
					<td><?php echo esc_html( $project['name'] ); ?></td>
					<td>
						<strong><?php echo esc_html( $project['progress'] ); ?>%</strong>
						<div class="consult-dashboard-progress">
							<span style="width: <?php echo esc_attr( $project['progress'] ); ?>%;"></span>
						</div>
					</td>
					<td><?php echo esc_html( $project['deadline'] ); ?></td>
					<td><?php echo esc_html( $project['lead'] ); ?></td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'Важные материалы', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Полезные документы и инструкции для работы', 'consult-dashboard' ); ?></p>
	</header>

	<div class="consult-dashboard__grid">
		<?php foreach ( $resources as $resource ) : ?>
			<article class="consult-dashboard__cta-card">
				<h3><?php echo esc_html( $resource['title'] ); ?></h3>
				<p><?php echo esc_html( $resource['description'] ); ?></p>
				<a href="<?php echo esc_url( $resource['link'] ); ?>">
					<?php esc_html_e( 'Открыть', 'consult-dashboard' ); ?>
				</a>
			</article>
		<?php endforeach; ?>
	</div>
</section>

