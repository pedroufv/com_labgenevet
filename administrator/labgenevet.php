<?php
/**
 * @version     1.0.0
 * @package     com_labgenevet
 * @copyright   Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Pedro Augusto <pams.pedro@gmail.com> - http://ther.com.br/
 */

// no direct access
defined('_JEXEC') or die;

// Access check.
if (!JFactory::getUser()->authorise('core.manage', 'com_labgenevet')) {
	throw new Exception(JText::_('JERROR_ALERTNOAUTHOR'));
}

// Register dependent classes.
JLoader::register('LabgenevetHelper', __DIR__ . '/helpers/labgenevet.php');

$controller	= JControllerLegacy::getInstance('Labgenevet');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();
