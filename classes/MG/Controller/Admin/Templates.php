<?php defined('SYSPATH') OR die('No direct script access.');
/**
 * View for admin templates.
 *
 * @package    MG/Admin
 * @category   Controller
 * @author     Modular Gaming Team
 * @copyright  (c) 2012-2013 Modular Gaming Team
 * @license    BSD http://modulargaming.com/license
 */
class MG_Controller_Admin_Templates extends Abstract_Controller_Admin {

	private $_directory = 'templates/Admin/Modal';

	public function action_index()
	{
		// TODO: Cache it!!!
		$templates = Kohana::list_files($this->_directory);
		$content = array();

		$last_changed = 0;
		foreach ($templates as $key => $value)
		{
			$changed = filemtime($value);
			$last_changed = max($last_changed, $changed);

			$key = str_replace($this->_directory.'/', '', $key);
			$key = str_replace('.mustache', '', $key);

			$value = file_get_contents($value);
			// $value = preg_replace('/\s\s+/', ' ', $value);
			// $value = stripslashes($value);

			$content[$key] = $value;
		}

		$this->response->headers('Content-Type', 'application/javascript');
		$this->response->headers('Last-Modified', (string) date('r', $last_changed));

		$this->response->body('TEMPLATES = '.json_encode($content));
	}

}
