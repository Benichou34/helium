<?php
/*
* The MIT License (MIT)
*
* Copyright (c) 2015 Benichou
*
* Permission is hereby granted, free of charge, to any person obtaining a copy
* of this software and associated documentation files (the "Software"), to deal
* in the Software without restriction, including without limitation the rights
* to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
* copies of the Software, and to permit persons to whom the Software is
* furnished to do so, subject to the following conditions:
*
* The above copyright notice and this permission notice shall be included in all
* copies or substantial portions of the Software.
*
* THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
* IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
* FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
* AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
* LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
* OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
* SOFTWARE.
*
*  @author    Benichou <benichou.software@gmail.com>
*  @copyright 2015 Benichou
*  @license   http://opensource.org/licenses/MIT  The MIT License (MIT)
*/

if (!defined('_PS_VERSION_'))
	exit;

class Helium extends Module
{
	public function __construct()
	{
		$this->name = 'helium';
		$this->tab = 'others';
		$this->author = 'Benichou';
		$this->version = '1.0';

		parent::__construct();
		$this->displayName = $this->l('Helium CSS');
		$this->description = $this->l('Helium is a tool for discovering unused CSS');
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
	}

	public function install()
	{
		if (!parent::install() || !$this->registerHook('header'))
			return false;

		return true;
	}

	public function uninstall()
	{
		if(!$this->unregisterHook('header'))
			return false;

		return parent::uninstall();
	}

	public function hookHeader($params)
	{
		$gsitemaps = Db::getInstance()->ExecuteS('SELECT * FROM `'._DB_PREFIX_.'gsitemap_sitemap` WHERE id_shop = '.(int)$this->context->shop->id);
		$links = '';

		foreach($gsitemaps as $maps)
		{
			$xml = new SimpleXMLElement(file_get_contents($maps['link']));
			foreach($xml->url as $val)
				$links .= $val->loc.'\n';
		}

		Media::addJsDef(array(
			'gsitemaps_links' => $links
		));

		$this->context->controller->addJs($this->_path.'helium.js', 'all');
	}
}
?>
