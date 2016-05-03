<?php
/**
 * @version     1.0.0
 * @package     com_labgenevet
 * @copyright   Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license     GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 * @author      Pedro Augusto <pams.pedro@gmail.com> - http://ther.com.br/
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modelform');
jimport('joomla.event.dispatcher');

/**
 * Labgenevet model.
 */
class LabgenevetModelRequestForm extends JModelForm
{
    var $_item = null;

    /**
     * Method to get an ojbect.
     *
     * @param    integer    The id of the object to get.
     *
     * @return    mixed    Object on success, false on failure.
     */
    public function &getData($id = null)
    {
        if ($this->_item === null) {

            $model = $this->getRelatedAdminModel('Request');

            $this->_item = $model->getItem($id);
        }

        return $this->_item;
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
        // Get the form.
        $form = $this->loadForm('com_labgenevet.requestform', 'requestform', array(
            'control' => 'jform',
            'load_data' => false
        ));

        $containersCheckboxes = $this->getRelatedAdminModel('Containers')->getXmlFieldCheckboxes();
        if($containersCheckboxes) {
            $form->setField($containersCheckboxes);
        }

        $examsCheckboxes = $this->getRelatedAdminModel('Exams')->getXmlFieldCheckboxes();
        if($examsCheckboxes) {
            $form->setField($examsCheckboxes);
        }

        if($loadData){
            @$form->bind($this->loadFormData());
        }


        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return    mixed    The data for the form.
     * @since    1.6
     */
    protected function loadFormData()
    {
        $data = JFactory::getApplication()->getUserState('com_labgenevet.requests.data', array());

        if (empty($data)) {
            $id = JFactory::getApplication()->input->get('id');
            $data = $this->getData($id);
        }

        return $data;
    }

    /**
     * save data in table and table related
     *
     * @param array $data
     * @return bool|void
     */
    public function save($data)
    {
        $input = JFactory::getApplication()->input;
        $inputArray = $input->post->getArray();
        $jformArray = $inputArray['jform'];

        $this->getRelatedAdminModel('Animal')->save($data['animals']);
        $data['animalsid'] = $this->getRelatedAdminModel('Animal')->getLastInsertId();

        $examsListCategory = $jformArray['examslist'];
        $examsList = array();
        foreach($examsListCategory as $category => $exams) {
            foreach($exams as $exam) {
                array_push($examsList, $exam);
            }
        }

        $data['situationsid'] = 1;
        $data['state'] = 1;
        $data['totalexams'] = count($examsList);
        $data['created'] = date('Y-m-d H:i:s');
        $data['created_by'] = JFactory::getUser()->id;

        $table = $this->getTable('request', 'LabgenevetTable');
        if ($table->save($data) === true) {
            $this->getRelatedAdminModel('Containerslist')->save($table->id, $data['containerslist']);
            $this->getRelatedAdminModel('Examslist')->save($table->id, $examsList);
            return $table->id;
        } else {
            return false;
        }
    }

    /**
     * Method to populate object with attributes related.
     *
     * @param   object.
     * @return  void
     */
    public function populateRelated(&$item)
    {
        if($item->animalsid) {
            $item->animals = $this->getRelatedAdminModel('Animal')->getItem($item->animalsid);
        }

        if($item->id) {
            $item->containerslist = $this->getRelatedAdminModel('containerslist')->getContainersInRequest($item->id);
            $item->examslist = $this->getRelatedAdminModel('examslist')->getExamsInRequestByCategory($item->id);
            $item->totalexams = count($this->getRelatedAdminModel('examslist')->getExamsInRequest($item->id));
        }
    }

    /**
     * get model related
     *
     * @param string $name
     * @return JModelLegacy
     */
    private function getRelatedAdminModel($name)
    {
        JModelLegacy::addIncludePath(JPATH_COMPONENT_ADMINISTRATOR . '/models', 'LabgenevetModel');
        $model = JModelLegacy::getInstance($name,'LabgenevetModel');
        return $model;
    }
}