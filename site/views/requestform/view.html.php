<?php
/**
 * @version     1.0.0
 * @package     com_labgenevet
 * @copyright   Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Pedro Augusto <pams.pedro@gmail.com> - http://ther.com.br/
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.view');

/**
 * View to edit
 */
class LabgenevetViewRequestForm extends JViewLegacy
{

	protected $state;
	protected $item;
	protected $form;
	protected $params;
	protected $canSave;

	/**
	 * Display the view
	 */
	public function display($tpl = null)
	{

		$app  = JFactory::getApplication();
		$user = JFactory::getUser();

		$this->state   	= $this->get('State');
		$this->item    	= $this->get('Data');
		$this->params  	= $app->getParams('com_labgenevet');
		$this->canSave 	= $this->get('CanSave');
		$this->form		= $this->get('Form');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new Exception(implode("\n", $errors));
		}

		$this->_prepareDocument();

		parent::display($tpl);
	}

	/**
	 * Prepares the document
	 */
	protected function _prepareDocument()
	{
		$app   = JFactory::getApplication();
		$menus = $app->getMenu();
		$title = null;

		// Because the application sets a default page title,
		// we need to get it from the menu item itself
		$menu = $menus->getActive();
		if ($menu)
		{
			$this->params->def('page_heading', $this->params->get('page_title', $menu->title));
		}
		else
		{
			$this->params->def('page_heading', JText::_('COM_LABGENEVET_DEFAULT_PAGE_TITLE'));
		}
		$title = $this->params->get('page_title', '');
		if (empty($title))
		{
			$title = $app->get('sitename');
		}
		elseif ($app->get('sitename_pagetitles', 0) == 1)
		{
			$title = JText::sprintf('JPAGETITLE', $app->get('sitename'), $title);
		}
		elseif ($app->get('sitename_pagetitles', 0) == 2)
		{
			$title = JText::sprintf('JPAGETITLE', $title, $app->get('sitename'));
		}
		$this->document->setTitle($title);

		if ($this->params->get('menu-meta_description'))
		{
			$this->document->setDescription($this->params->get('menu-meta_description'));
		}

		if ($this->params->get('menu-meta_keywords'))
		{
			$this->document->setMetadata('keywords', $this->params->get('menu-meta_keywords'));
		}

		if ($this->params->get('robots'))
		{
			$this->document->setMetadata('robots', $this->params->get('robots'));
		}
	}
}
