<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Labgenevet
 * @author     Pedro Augusto <pams.pedro@gmail.com>
 * @copyright  Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

// No direct access
defined('_JEXEC') or die;

jimport('joomla.application.component.controllerform');

/**
 * Request controller class.
 *
 * @since  1.6
 */
class LabgenevetControllerRequest extends JControllerForm
{
	/**
	 * Constructor
	 *
	 * @throws Exception
	 */
	public function __construct()
	{
		$this->view_list = 'requests';
		parent::__construct();
	}

    /**
     * Print Preview
     * @throws Exception
     */
	public function printer()
	{
		// Get the input
        $pk = JFactory::getApplication()->input->getInt('id');

		// Redirect to the list screen.
		$this->setRedirect(JRoute::_('index.php?option=com_labgenevet&view=request&tmpl=component&layout=print&print=1&id='.$pk, false));
	}
}
