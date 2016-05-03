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

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Labgenevet records.
 *
 * @since  1.6
 */
class LabgenevetModelContainerslist extends JModelAdmin
{
	/**
	 * @var      string    The prefix to use with controller messages.
	 * @since    1.6
	 */
	protected $text_prefix = 'COM_LABGENEVET';

	/**
	 * Returns a reference to the a Table object, always creating it.
	 *
	 * @param   string  $type    The table type to instantiate
	 * @param   string  $prefix  A prefix for the table class name. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return    JTable    A database object
	 *
	 * @since    1.6
	 */
	public function getTable($type = 'Containerslist', $prefix = 'LabgenevetTable', $config = array())
	{
		return JTable::getInstance($type, $prefix, $config);
	}

    /**
     * Method to get the record form.
     *
     * @param   array    $data      An optional array of data for the form to interogate.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  JForm  A JForm object on success, false on failure
     *
     * @since    1.6
     */
    public function getForm($data = array(), $loadData = true)
    {
        // Initialise variables.
        $app = JFactory::getApplication();

        // Get the form.
        $form = $this->loadForm(
            'com_labgenevet.containerlist', 'containerlist',
            array('control' => 'jform',
                'load_data' => $loadData
            )
        );

        if (empty($form)) {
            return false;
        }

        return $form;
    }

	/**
	 *  search containers in request
	 *  @return mixed array assoc title => id or false
	 */
	public function getContainersInRequest($requestid, $key = 'title', $value = 'id')
	{
		$db = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select('containers.id, containers.title');
		$query->from('`#__labgenevet_containerslist` AS containerslist');
		$query->innerJoin('`#__labgenevet_containers` AS `containers` ON `containers`.id = containerslist.`containersid`');
		$query->where('containerslist.requestsid = '.$requestid);

		$db->setQuery($query);

		return $db->loadAssocList('title', 'id');
	}

	/**
	 *  drop all items for request and save new list
	 *  @param int $requestid
	 *  @param array $containerslist
     *  @return bool
	 */
	public function save($requestid, $containerslist)
	{
        $oldContainersList = $this->getContainersInRequest($requestid);
        foreach($oldContainersList as $oldContainersid) {
            if(!in_array($oldContainersid, $containerslist)) {
                $pk = array('requestsid' => $requestid, 'containersid' => $oldContainersid);
                $this->getTable()->delete($pk);
            }
        }

        foreach($containerslist as $containersid) {
            $pk = array('requestsid' => $requestid, 'containersid' => $containersid);
            if(!$this->getTable()->load($pk)) {
                $this->getTable()->save($pk);
            }
        }

        return true;
	}
}

