<?php
/**
 * Административная панель дашборда.
 *
 * @var WP_User $args['user']
 * @var string  $args['user_role']
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$user      = $args['user'] ?? wp_get_current_user();
$user_name = $user instanceof WP_User ? $user->display_name : '';

$metrics = [
	[
		'title' => __( 'Активные проекты', 'consult-dashboard' ),
		'value' => '12',
		'trend' => '+3',
		'trend_class' => 'consult-dashboard-card__trend consult-dashboard-card__trend--up',
		'meta'  => __( 'За последнюю неделю', 'consult-dashboard' ),
	],
	[
		'title' => __( 'Выручка (₽)', 'consult-dashboard' ),
		'value' => '1,24 млн',
		'trend' => '+12%',
		'trend_class' => 'consult-dashboard-card__trend consult-dashboard-card__trend--up',
		'meta'  => __( 'Прогноз на месяц', 'consult-dashboard' ),
	],
	[
		'title' => __( 'Заявки в работе', 'consult-dashboard' ),
		'value' => '27',
		'trend' => '-5',
		'trend_class' => 'consult-dashboard-card__trend consult-dashboard-card__trend--down',
		'meta'  => __( 'Требуют внимания', 'consult-dashboard' ),
	],
];

$team = [
	[
		'name'   => 'Анна Карпова',
		'role'   => __( 'Руководитель проектов', 'consult-dashboard' ),
		'status' => 'success',
		'label'  => __( 'Онлайн', 'consult-dashboard' ),
	],
	[
		'name'   => 'Пётр Власов',
		'role'   => __( 'Финансовый консультант', 'consult-dashboard' ),
		'status' => 'warning',
		'label'  => __( 'Уточняет данные', 'consult-dashboard' ),
	],
	[
		'name'   => 'Мария Щеглова',
		'role'   => __( 'HR эксперт', 'consult-dashboard' ),
		'status' => 'success',
		'label'  => __( 'Встреча в Zoom', 'consult-dashboard' ),
	],
];

$activities = [
	[
		'title' => __( 'Запуск нового корпоративного портала', 'consult-dashboard' ),
		'description' => __( 'Подписан контракт и назначена команда', 'consult-dashboard' ),
		'timestamp' => __( '1 час назад', 'consult-dashboard' ),
	],
	[
		'title' => __( 'Финальный отчёт по проекту «Рост HR-показателей»', 'consult-dashboard' ),
		'description' => __( 'Отчёт отправлен клиенту и ожидает подтверждения', 'consult-dashboard' ),
		'timestamp' => __( 'Сегодня в 09:40', 'consult-dashboard' ),
	],
	[
		'title' => __( 'Перенос консультации по Digital-стратегии', 'consult-dashboard' ),
		'description' => __( 'Новая дата согласована с клиентом', 'consult-dashboard' ),
		'timestamp' => __( 'Вчера в 18:25', 'consult-dashboard' ),
	],
];

$invoices = [
	[
		'number' => 'INV-3245',
		'client' => 'ООО «Статус Групп»',
		'amount' => '165 000 ₽',
		'due'    => __( '15 ноября', 'consult-dashboard' ),
		'status' => 'success',
		'status_label' => __( 'Оплачено', 'consult-dashboard' ),
	],
	[
		'number' => 'INV-3246',
		'client' => 'АО «Север-Инвест»',
		'amount' => '98 000 ₽',
		'due'    => __( '22 ноября', 'consult-dashboard' ),
		'status' => 'warning',
		'status_label' => __( 'Ожидает', 'consult-dashboard' ),
	],
	[
		'number' => 'INV-3247',
		'client' => 'ИП «Ковалёв А.С.»',
		'amount' => '54 300 ₽',
		'due'    => __( 'Просрочено на 3 дня', 'consult-dashboard' ),
		'status' => 'danger',
		'status_label' => __( 'Просрочено', 'consult-dashboard' ),
	],
];
?>

<section class="consult-dashboard__grid" aria-label="<?php esc_attr_e( 'Ключевые показатели', 'consult-dashboard' ); ?>">
	<?php foreach ( $metrics as $metric ) : ?>
		<article class="consult-dashboard-card consult-dashboard-card--metric">
			<h2 class="consult-dashboard-card__title"><?php echo esc_html( $metric['title'] ); ?></h2>
			<p class="consult-dashboard-card__value"><?php echo esc_html( $metric['value'] ); ?></p>
			<span class="<?php echo esc_attr( $metric['trend_class'] ); ?>">
				<?php echo esc_html( $metric['trend'] ); ?>
			</span>
			<p class="consult-dashboard-card__meta"><?php echo esc_html( $metric['meta'] ); ?></p>
		</article>
	<?php endforeach; ?>
</section>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'Команда на проектах', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Статусы и активности ключевых специалистов', 'consult-dashboard' ); ?></p>
	</header>

	<table class="consult-dashboard-table">
		<thead>
			<tr>
				<th><?php esc_html_e( 'Сотрудник', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Роль', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Статус', 'consult-dashboard' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $team as $member ) : ?>
				<tr>
					<td><?php echo esc_html( $member['name'] ); ?></td>
					<td><?php echo esc_html( $member['role'] ); ?></td>
					<td>
						<span class="consult-dashboard-status consult-dashboard-status--<?php echo esc_attr( $member['status'] ); ?>">
							<?php echo esc_html( $member['label'] ); ?>
						</span>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'Финансовые документы', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Проверка статуса счётов и оплат от клиентов', 'consult-dashboard' ); ?></p>
	</header>

	<table class="consult-dashboard-table">
		<thead>
			<tr>
				<th><?php esc_html_e( '№ счёта', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Клиент', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Сумма', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Срок', 'consult-dashboard' ); ?></th>
				<th><?php esc_html_e( 'Статус', 'consult-dashboard' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ( $invoices as $invoice ) : ?>
				<tr>
					<td><?php echo esc_html( $invoice['number'] ); ?></td>
					<td><?php echo esc_html( $invoice['client'] ); ?></td>
					<td><?php echo esc_html( $invoice['amount'] ); ?></td>
					<td><?php echo esc_html( $invoice['due'] ); ?></td>
					<td>
						<span class="consult-dashboard-status consult-dashboard-status--<?php echo esc_attr( $invoice['status'] ); ?>">
							<?php echo esc_html( $invoice['status_label'] ); ?>
						</span>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</section>

<section class="consult-dashboard-card">
	<header>
		<h2 class="consult-dashboard-card__title"><?php esc_html_e( 'Последние события', 'consult-dashboard' ); ?></h2>
		<p><?php esc_html_e( 'Сводка ключевых изменений и статусов проектов', 'consult-dashboard' ); ?></p>
	</header>

	<ul class="consult-dashboard-timeline">
		<?php foreach ( $activities as $activity ) : ?>
			<li class="consult-dashboard-timeline__item">
				<h3 class="consult-dashboard-timeline__title"><?php echo esc_html( $activity['title'] ); ?></h3>
				<p class="consult-dashboard-timeline__meta">
					<?php echo esc_html( $activity['description'] ); ?> · <?php echo esc_html( $activity['timestamp'] ); ?>
				</p>
			</li>
		<?php endforeach; ?>
	</ul>
</section>

<section class="consult-dashboard__cta" aria-label="<?php esc_attr_e( 'Быстрые действия', 'consult-dashboard' ); ?>">
	<article class="consult-dashboard__cta-card">
		<h3><?php esc_html_e( 'Добавить новый проект', 'consult-dashboard' ); ?></h3>
		<p><?php esc_html_e( 'Запустите новый проект, назначьте команду и опишите цели клиента.', 'consult-dashboard' ); ?></p>
		<a href="<?php echo esc_url( admin_url( 'post-new.php?post_type=project' ) ); ?>">
			<?php esc_html_e( 'Создать проект', 'consult-dashboard' ); ?>
		</a>
	</article>

	<article class="consult-dashboard__cta-card">
		<h3><?php esc_html_e( 'Назначить консультацию', 'consult-dashboard' ); ?></h3>
		<p><?php esc_html_e( 'Подберите эксперта и согласуйте удобное окно с клиентом.', 'consult-dashboard' ); ?></p>
		<a href="<?php echo esc_url( admin_url( 'edit.php?post_type=appointment' ) ); ?>">
			<?php esc_html_e( 'Открыть расписание', 'consult-dashboard' ); ?>
		</a>
	</article>
</section>

