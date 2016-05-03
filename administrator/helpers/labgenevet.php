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

/**
 * Labgenevet helper.
 */
class LabgenevetHelper {

    /**
     * Configure the Linkbar.
     */
    public static function addSubmenu($vName = '')
    {
        JHtmlSidebar::addEntry(
            JText::_('COM_LABGENEVET_REQUESTS'),
            'index.php?option=com_labgenevet&view=requests',
            $vName == 'requests'
        );
        JHtmlSidebar::addEntry(
            JText::_('JCATEGORIES') . ' (' . JText::_('COM_LABGENEVET_EXAMS') . ')',
            "index.php?option=com_categories&extension=com_labgenevet",
            $vName == 'categories'
        );
        JHtmlSidebar::addEntry(
            JText::_('COM_LABGENEVET_EXAMS'),
            'index.php?option=com_labgenevet&view=exams',
            $vName == 'exams'
        );
        JHtmlSidebar::addEntry(
            JText::_('COM_LABGENEVET_CONTAINERS'),
            'index.php?option=com_labgenevet&view=containers',
            $vName == 'containers'
        );
        JHtmlSidebar::addEntry(
            JText::_('COM_LABGENEVET_SITUATIONS'),
            'index.php?option=com_labgenevet&view=situations',
            $vName == 'situations'
        );
        JHtmlSidebar::addEntry(
            JText::_('COM_LABGENEVET_SPECIES'),
            'index.php?option=com_labgenevet&view=species',
            $vName == 'species'
        );
        JHtmlSidebar::addEntry(
            JText::_('COM_LABGENEVET_BREEDS'),
            'index.php?option=com_labgenevet&view=breeds',
            $vName == 'breeds'
        );
    }

    /**
     * Gets a list of the actions that can be performed.
     *
     * @return	JObject
     * @since	1.6
     */
    public static function getActions() {
        $user = JFactory::getUser();
        $result = new JObject;

        $assetName = 'com_labgenevet';

        $actions = array(
            'core.admin', 'core.manage', 'core.create', 'core.edit', 'core.edit.own', 'core.edit.state', 'core.delete'
        );

        foreach ($actions as $action) {
            $result->set($action, $user->authorise($action, $assetName));
        }

        return $result;
    }

    /**
     * get user data stored in cck custom fields
     * @return mixed
     */
    public static function getCckStoreFormUser($created_by)
    {
        $user = JFactory::getUser($created_by);

        if(!$user) {
            return false;
        } else {
            $userId = $user->get('id');

            try {
                $db = JFactory::getDbo();
                $query = $db->getQuery(true);
                $query->select('*');
                $query->from('#__cck_store_form_user');
                $query->where('id = '.$userId);
                $db->setQuery($query);
                $results = $db->loadObject();

                return $results;

            } catch(Exception $e) {
                //echo "<div class='alert'>Não foi possivel carregar as informções adicionais do usuário {$user->get('name')}.</div>";
                return false;
            }
        }
    }
}
