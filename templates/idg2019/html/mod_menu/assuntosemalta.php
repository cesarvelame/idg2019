<?php
/**
 * @package		Joomla.Site
 * @subpackage	mod_menu
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
?>

<div class="em-alta">

		<?php
		foreach ($list as $i => &$item) :
			$class = 'item-'.$item->id;
			if ($item->id == $active_id) {
				$class .= ' current';
			}

			if (in_array($item->id, $path)) {
				$class .= ' active';
			}
			elseif ($item->type == 'alias') {
				$aliasToId = $item->params->get('aliasoptions');
				if (count($path) > 0 && $aliasToId == $path[count($path)-1]) {
					$class .= ' active';
				}
				elseif (in_array($aliasToId, $path)) {
					$class .= ' alias-parent-active';
				}
			}

			if ($item->deeper) {
				$class .= ' deeper';
			}

			if ($item->parent) {
				$class .= ' parent';
			}

			if (!empty($class)) {
				$class = ' class="'.trim($class) .'"';
			}

			//echo '<li'.$class.'>';

			// Render the menu item.
			switch ($item->type) :
				case 'separator':
				case 'url':
				case 'component':
					require JModuleHelper::getLayoutPath('mod_menu', 'menuprincipal_'.$item->type);
					break;

				default:
					require JModuleHelper::getLayoutPath('mod_menu', 'menuprincipal_url');
					break;
			endswitch;

			// The next item is deeper.
			if ($item->deeper) {
				//echo '<ul>';
			}
			// The next item is shallower.
			elseif ($item->shallower) {
				//echo '</li>';
				//echo str_repeat('</ul></li>', $item->level_diff);
				echo str_repeat('', $item->level_diff);
			}
			// The next item is on the same level.
			else {
				//echo '</li>';
			}
		endforeach;
		?>
</div>