<?php

	class Template extends Smarty{
		
		const TEMPLATE_DIR 	= "templates";
		const CACHE_DIR		= "cache";
		const COMPILE_DIR	= "compile";
		const CONFIG_DIR	= "config";
		
		/**
		 * Initialize smarty template class
		 */
		public function __construct($template, $producation = true, $appName = 'Heart Web Project') {
			parent::__construct();

			$this->template_dir = ROOT_DIR . DS . $template . DS . TEMPLATE_DIR;
			$this->compile_dir  = ROOT_DIR . DS . $template . DS . COMPILE_DIR;
			$this->config_dir   = ROOT_DIR . DS . $template . DS . CONFIG_DIR;
			$this->cache_dir    = ROOT_DIR . DS . $template . DS . CACHE_DIR;

			//$this->caching = Smarty::CACHING_LIFETIME_CURRENT;
			$this->assign('app_name', $appName);

		}// end fn: __construct
	} // end class: Template