<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Abstract View for admin.
 *
 * @package    MG/Admin
 * @category   View
 * @author     Modular Gaming Team
 * @copyright  (c) 2012-2013 Modular Gaming Team
 * @license    BSD http://modulargaming.com/license
 */
class MG_Abstract_View_Admin extends Abstract_View {

	protected $_assets_group = 'backend';

	public $subnav = array();

	public function navigation()
	{
		$nav = array_reverse(Event::fire('admin.nav_list'));
		$list = array(
			array(
				'title' => 'Dashboard',
				'link'  => URL::site('admin'),
				'icon'  => 'icon-home',
			)
		);
		return array_merge($list, $nav);
	}

	public function subnav()
	{
		$list = array();
		foreach ($this->subnav as $nav) {
			$list[] = $nav;
		}
		return $list;
	}

	public function has_subnav()
	{
		return (is_array($this->subnav) AND count($this->subnav) > 0);
	}
}
