<?php
if (STM_LMS_User_Menu::float_menu_enabled()) return false;

$visible_items = apply_filters('stm_lms_account_tabs_visible', 6);

$current_user = STM_LMS_User::get_current_user(null, true, true);
$lms_template_current = get_query_var('lms_template');
$object_id = get_queried_object_id();
$menu_items = STM_LMS_User::user_menu_float_items($current_user, $lms_template_current, $object_id);
$menu_items_total = count($menu_items);

$main_items = array_slice($menu_items, 0, $visible_items);
if ($menu_items_total > count($main_items)) $sub_items = array_slice($menu_items, -(count($menu_items) - $visible_items));

stm_lms_register_style('float_menu/tabs');
stm_lms_register_script('float_menu/tabs');


if (!empty($sub_items)) $sub_items = array_chunk($sub_items, 6);

?>

<div class="stm_lms_acc_tabs <?php if (!empty($sub_items)) echo esc_attr('has_sub_items'); ?>">

	<div class="stm_lms_acc_tabs__main">
		<?php foreach ($main_items as $menu_item) {
			$item_type = (!empty($menu_item['type'])) ? $menu_item['type'] : 'dynamic_menu_item';
			if ($item_type !== 'dynamic_menu_item') continue;
			STM_LMS_Templates::show_lms_template("account/float_menu/menu_items/{$item_type}", $menu_item);
		} ?>
	</div>

	<?php if (!empty($sub_items)): ?>

		<div class="stm_lms_acc_tabs__secondary">

			<i class="stm_lms_acc_tabs__toggle fa fa-ellipsis-v"></i>

			<div class="stm_lms_acc_tabs__secondary_inner">

				<?php foreach ($sub_items as $menu_section): ?>

					<div class="stm_lms_acc_tabs__secondary_inner__section">

						<?php foreach ($menu_section as $menu_item): ?>

							<?php $item_type = (!empty($menu_item['type'])) ? $menu_item['type'] : 'dynamic_menu_item';
							if ($item_type !== 'dynamic_menu_item') continue;
							STM_LMS_Templates::show_lms_template("account/float_menu/menu_items/{$item_type}", $menu_item); ?>

						<?php endforeach; ?>

					</div>

				<?php endforeach; ?>

			</div>

		</div>

	<?php endif; ?>

</div>
