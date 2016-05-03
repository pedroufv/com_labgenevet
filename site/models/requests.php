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

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Labgenevet records.
 */
class LabgenevetModelRequests extends JModelList
{
	/**
	 * Model context string.
	 *
	 * @var     string
	 */
	public $_context = 'com_labgenevet.requests';

	/**
	 * The category context (allows other extensions to derived from this model).
	 *
	 * @var     string
	 */
	protected $_extension = 'com_labgenevet';

	/**
	 * The parent object.
	 *
	 * @type    JCategoryNode
	 */
	private $_parent = null;

	/**
	 * List of items.
	 *
	 * @type    array
	 */
	private $_items = null;

    /**
     * Constructor.
     *
     * @param    array    An optional associative array of configuration settings.
     * @see      JController
     * @since    1.6
     */
    public function __construct($config = array())
    {
        if (empty($config['filter_fields'])) {
            $config['filter_fields'] = array(
                'id', 'a.`id`',
                'animalsid', 'a.`animalsid`',
                'containersid', 'a.`containersid`',
                'situetionsid', 'a.`situationsid`',
                'filename', 'a.`filename`',
                'created', 'a.`created`',
                'urgent', 'a.`urgent`',
                'ordering', 'a.`ordering`',
                'state', 'a.`state`',
                'created_by', 'a.`created_by`',
            );
        }

        parent::__construct($config);
    }

    /**
     * Method to auto-populate the model state.
     *
     * Note. Calling getState in this method will result in recursion.
     *
     * @param   string  $ordering   An optional ordering field.
     * @param   string  $direction  An optional direction (asc|desc).
     *
     * @return  void
     *
     * @since   3.2
     */
    protected function populateState($ordering = null, $direction = null)
    {
        // Initialiase variables.
        $app = JFactory::getApplication();
        $this->setState('filter.extension', $this->_extension);

        // Get the parent id if defined.
        $parentId = $app->input->getInt('id');
        $this->setState('filter.parentId', $parentId);

        $params = $app->getParams();
        $this->setState('params', $params);

        $this->setState('filter.state', 1);
        $this->setState('filter.access', true);
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param   string  $id  A prefix for the store id.
     *
     * @return  string  A store id.
     *
     * @since   3.2
     */
    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id .= ':' . $this->getState('filter.extension');
        $id .= ':' . $this->getState('filter.state');
        $id .= ':' . $this->getState('filter.access');
        $id .= ':' . $this->getState('filter.parentId');

        return parent::getStoreId($id);
    }

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return    JDatabaseQuery
	 * @since    1.6
	 */
	protected function getListQuery()
	{
        // get user for search items by $user->id
        $user = JFactory::getUser();

		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select($this->getState('list.select', 'DISTINCT a.*'));

		$query->from('`#__labgenevet_requests` AS a');

        // Join over the animal 'animalsid'
        $query->select('`animalsid`');
        $query->join('LEFT', '#__labgenevet_animals AS `animalsid` ON `animalsid`.id = a.`animalsid`');
        // Join over the progress 'progressid'
        $query->select('`situationsid`.title AS `situationsid`');
        $query->join('LEFT', '#__labgenevet_situations AS `situationsid` ON `situationsid`.id = a.`situationsid`');
        // Join over the users for the checked out user
        $query->select("uc.name AS editor");
        $query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");
        // Join over the user field 'created_by'
        $query->select('`created_by`.id AS `created_by`');
        $query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');
        $query->where('a.`created_by` = '.$user->id);
		
		if (!JFactory::getUser()->authorise('core.edit.state', 'com_labgenevet'))
		{
			$query->where('a.state = 1');
		}

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.`animalsid` LIKE '.$search.'  OR  a.`clinicsid` LIKE '.$search.' OR  a.`situationsid` LIKE '.$search.' )');
            }
        }

		/*Filtering catid
		$filter_catid = $this->state->get("filter.catid");
		if ($filter_catid) {
			$query->where("a.catid = '".$db->escape($filter_catid)."'");
		}*/

		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering');
		$orderDirn = $this->state->get('list.direction');
		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	public function getItems()
	{
		$items = parent::getItems();

		foreach($items as $item) {
            $this->getRelatedModel('requestform')->populateRelated($item);
        }

		return $items;
	}

	/**
	 * get model related
	 *
	 * @param string $name
	 * @return JModelLegacy
	 */
	private function getRelatedModel($name)
	{
		$model = JModelLegacy::getInstance($name,'LabgenevetModel');
		return $model;
	}

	/**
	 * Overrides the default function to check Date fields format, identified by
	 * "_dateformat" suffix, and erases the field if it's not correct.
	 */
	protected function loadFormData()
	{
		$app              = JFactory::getApplication();
		$filters          = $app->getUserState($this->context . '.filter', array());
		$error_dateformat = false;
		foreach ($filters as $key => $value)
		{
			if (strpos($key, '_dateformat') && !empty($value) && !$this->isValidDate($value))
			{
				$filters[ $key ]  = '';
				$error_dateformat = true;
			}
		}
		if ($error_dateformat)
		{
			$app->enqueueMessage(JText::_("COM_LABGENEVET_SEARCH_FILTER_DATE_FORMAT"), "warning");
			$app->setUserState($this->context . '.filter', $filters);
		}

		return parent::loadFormData();
	}

	/**
	 * Checks if a given date is valid and in an specified format (YYYY-MM-DD)
	 *
	 * @param string $date the date to be checked
	 * @return bool
	 */
	private function isValidDate($date)
	{
		return preg_match("/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/", $date) && date_create($date);
	}
}
