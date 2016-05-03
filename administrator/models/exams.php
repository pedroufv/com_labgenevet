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

jimport('joomla.application.component.modellist');

/**
 * Methods supporting a list of Labgenevet records.
 */
class LabgenevetModelExams extends JModelList {

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
                'catid', 'a.`catid`',
                'title', 'a.`title`',
                'code', 'a.`code`',
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
     */
    protected function populateState($ordering = null, $direction = null)
    {
        // Initialise variables.
        $app = JFactory::getApplication('administrator');

        // Load the filter state.
        $search = $app->getUserStateFromRequest($this->context . '.filter.search', 'filter_search');
        $this->setState('filter.search', $search);

        $published = $app->getUserStateFromRequest($this->context . '.filter.state', 'filter_published', '', 'string');
        $this->setState('filter.state', $published);
        
		//Filtering catid
		$this->setState('filter.catid', $app->getUserStateFromRequest($this->context.'.filter.catid', 'filter_catid', '', 'string'));

        // Load the parameters.
        $params = JComponentHelper::getParams('com_labgenevet');
        $this->setState('params', $params);

        // List state information.
        parent::populateState('a.catid', 'asc');
    }

    /**
     * Method to get a store id based on model configuration state.
     *
     * This is necessary because the model is used by the component and
     * different modules that might need different sets of data or different
     * ordering requirements.
     *
     * @param	string		$id	A prefix for the store id.
     * @return	string		A store id.
     * @since	1.6
     */
    protected function getStoreId($id = '')
    {
        // Compile the store id.
        $id.= ':' . $this->getState('filter.search');
        $id.= ':' . $this->getState('filter.state');

        return parent::getStoreId($id);
    }

    /**
     * Build an SQL query to load the list data.
     *
     * @return	JDatabaseQuery
     * @since	1.6
     */
    protected function getListQuery()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
                $this->getState(
                        'list.select', 'DISTINCT a.*'
                )
        );
        $query->from('`#__labgenevet_exams` AS a');

        
		// Join over the users for the checked out user
		$query->select("uc.name AS editor");
		$query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");
		// Join over the category 'catid'
		$query->select('`catid`.title AS `catid`');
		$query->join('LEFT', '#__categories AS `catid` ON `catid`.id = a.`catid`');
		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');


		// Filter by published state
		$published = $this->getState('filter.state');
		if (is_numeric($published)) {
			$query->where('a.state = ' . (int) $published);
		} else if ($published === '') {
			$query->where('(a.state IN (0, 1))');
		}

        // Filter by search in title
        $search = $this->getState('filter.search');
        if (!empty($search)) {
            if (stripos($search, 'id:') === 0) {
                $query->where('a.id = ' . (int) substr($search, 3));
            } else {
                $search = $db->Quote('%' . $db->escape($search, true) . '%');
                $query->where('( a.`catid` LIKE '.$search.'  OR  a.`title` LIKE '.$search.'  OR  a.`code` LIKE '.$search.' )');
            }
        }

		//Filtering catid
		$filter_catid = $this->state->get("filter.catid");
		if ($filter_catid) {
			$query->where("a.`catid` = '".$db->escape($filter_catid)."'");
		}

        // Add the list ordering clause.
        $orderCol = $this->state->get('list.ordering');
        $orderDirn = $this->state->get('list.direction');
        if ($orderCol && $orderDirn) {
            $query->order($db->escape($orderCol . ' ' . $orderDirn));
        }

        return $query;
    }

    public function getItems()
    {
        $items = parent::getItems();
        
        return $items;
    }

    public function getCategories()
    {
        // Create a new query object.
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select(
            $this->getState(
                'list.select', 'DISTINCT a.catid'
            )
        );
        $query->from('`#__labgenevet_exams` AS a');

        // Join over the category 'catid'
        $query->select('`category`.title AS `cattitle`, a.catid');
        $query->join('LEFT', '#__categories AS `category` ON `category`.id = a.`catid`');

        $db->setQuery($query);

        return $db->loadAssocList('cattitle' , 'catid');
    }

    /**
     *  search for all exams and return an array with title as key and id as value
     *  @return mixed array assoc title => id or false
     */
    public function getAssocList($key = 'title', $value = 'id')
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('exams.'.$key.', exams.'.$value);
        $query->from('`#__labgenevet_exams` AS `exams`');

        $db->setQuery($query);

        return $db->loadAssocList($key, $value);
    }

    /**
     *  search for all exams and return an array with title as key and id as value
     *  @return mixed array assoc title => id or false
     */
    public function getExamsInCategory($category, $key = 'title', $value = 'id')
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('*');
        $query->from('`#__labgenevet_exams` AS `exams`');
        $query->where('exams.catid = '.$category);

        $db->setQuery($query);

        return $db->loadAssocList();
    }

    /**
     *  build fieldset in xml with array
     *
     * @return mixed SimpleXMLElement or false
     *
     */
    public function getXmlFieldCheckboxes()
    {
        $categories = $this->getCategories();

        if(count($categories) == 0) {
            return false;
        }

        $field = '';
        foreach ($categories as $catTitle => $catId) {
            $examslist = $this->getExamsInCategory($catId);

            $options = '';
            foreach ($examslist as $exam) {
                $options .= '<option class="checkexam" value="'.$exam['id'].'">'.$exam['title'].'</option>';
            }

            $field .= '<field name="'.$catId.'" filter="boolean" type="checkboxes" label="'.$catTitle.'">'.$options.'</field>';
        }

        $fields = '<fields name="examslist">'.$field.'</fields>';

        $element = new SimpleXMLElement($fields);

        return $element;
    }

    public function getTotalPrice($examsList)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('SUM(price)');
        $query->from('`#__labgenevet_exams` AS exams');
        $query->where('exams.id IN ('.implode(',', $examsList).')');

        $db->setQuery($query);

        return $db->loadResult();
    }
}
