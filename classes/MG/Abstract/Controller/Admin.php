<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * Abstract Controller for admin.
 *
 * @package    MG/Admin
 * @category   Controller
 * @author     Modular Gaming Team
 * @copyright  (c) 2012-2013 Modular Gaming Team
 * @license    BSD http://modulargaming.com/license
 */
class MG_Abstract_Controller_Admin extends Abstract_Controller_Frontend {

	protected $layout = 'Admin/layout';
	protected $protected = TRUE;

	public function before()
	{
		parent::before();

		$permission = $this->request->controller().'_'.$this->request->action();
	}

	public function after()
	{
		// if no subnav has been defined search for one
		if ($this->view !== NULL AND ! $this->view->has_subnav())
		{
			$this->_nav(strtolower($this->request->controller()), $this->request->action());
		}

		parent::after();
	}

	protected function _nav($type, $action='index')
	{
		$nav = Kohana::$config->load('admin.'.$type.'.nav');

		if ($nav != FALSE)
		{
			$nav[$action]['active'] = TRUE;
			$this->view->subnav = $nav;
		}
	}

}
