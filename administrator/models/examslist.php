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
class LabgenevetModelExamslist extends JModelAdmin
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
    public function getTable($type = 'Examslist', $prefix = 'LabgenevetTable', $config = array())
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
            'com_labgenevet.examslist', 'examslist',
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
     *  search categories in request
     *  @return mixed array assoc title => id or false
     */
    public function getCategoriesInRequest($requestid)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('DISTINCT exams.catid');
        $query->from('`#__labgenevet_examslist` AS examslist');
        $query->innerJoin('`#__labgenevet_exams` AS `exams` ON `exams`.id = examslist.`examsid`');
        $query->where('examslist.requestsid = '.$requestid);

        $db->setQuery($query);

        return $db->loadColumn();
    }

    /**
     *  search exams in request
     *  @return mixed array assoc title => id or false
     */
    public function getExamsInRequest($requestid)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select the required fields from the table.
        $query->select('exams.id, exams.title');
        $query->from('`#__labgenevet_examslist` AS examslist');
        $query->innerJoin('`#__labgenevet_exams` AS `exams` ON `exams`.id = examslist.`examsid`');
        $query->where('examslist.requestsid = '.$requestid);

        $db->setQuery($query);

        return $db->loadAssocList('title', 'id');
    }

    /**
     * get exams in request by category
     * @param int $requestid
     * @return array
     */
    public function getExamsInRequestByCategory($requestid)
    {
        $categories = $this->getCategoriesInRequest($requestid);
        $examsList = '';
        foreach($categories as $key => $value) {
            $examsList[$value] = $this->getExamsInRequest($requestid);
        }

        return $examsList;
    }

    /**
     *  drop all items for request and save new list
     *  @param int $requestid
     *  @param array $examslist
     *  @return bool
     */
    public function save($requestid, $examslist)
    {
        $oldExamsList = $this->getExamsInRequest($requestid);
        foreach($oldExamsList as $oldContainersid) {
            if(!in_array($oldContainersid, $examslist)) {
                $pk = array('requestsid' => $requestid, 'examsid' => $oldContainersid);
                $this->getTable()->delete($pk);
            }
        }

        foreach($examslist as $examsid) {
            $pk = array('requestsid' => $requestid, 'examsid' => $examsid);
            if(!$this->getTable()->load($pk)) {
                $this->getTable()->save($pk);
            }
        }

        return true;
    }
}
