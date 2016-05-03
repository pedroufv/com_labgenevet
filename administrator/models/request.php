<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Labgenevet
 * @author     Pedro Augusto <pams.pedro@gmail.com>
 * @copyright  Copyright (C) LabGene 2015. Todos os direitos reservados.
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

// No direct access.
defined('_JEXEC') or die;

jimport('joomla.application.component.modeladmin');
jimport('joomla.filesystem.file');

/**
 * Labgenevet model.
 *
 * @since  1.6
 */
class LabgenevetModelRequest extends JModelAdmin
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
	public function getTable($type = 'Request', $prefix = 'LabgenevetTable', $config = array())
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
        // Get the form.
		$form = $this->loadForm(
			'com_labgenevet.request', 'request',
			array('control' => 'jform',
				'load_data' => false
			)
		);

        $containersCheckboxes = $this->getRelatedModel('Containers')->getXmlFieldCheckboxes();
        if($containersCheckboxes) {
            $form->setField($containersCheckboxes);
        }

        $examsCheckboxes = $this->getRelatedModel('Exams')->getXmlFieldCheckboxes();
        if($examsCheckboxes) {
            $form->setField($examsCheckboxes);
        }

        @$form->bind($this->loadFormData());

		if (empty($form)) {
			return false;
		}

		return $form;
	}

	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return   mixed  The data for the form.
	 *
	 * @since    1.6
	 */
	protected function loadFormData()
	{
		// Check the session for previously entered form data.
		$data = JFactory::getApplication()->getUserState('com_labgenevet.edit.request.data', array());

		if (empty($data)) {
			$data = $this->getItem();
		}

		return $data;
	}

	/**
	 * Method to get a single record.
	 *
	 * @param   integer  $pk  The id of the primary key.
	 *
	 * @return  mixed    Object on success, false on failure.
	 *
	 * @since    1.6
	 */
	public function getItem($pk = null)
	{
		if ($item = parent::getItem($pk)) {
            $item->animals = $this->getRelatedModel('Animal')->getItem($item->animalsid);
            $key = $this->getTable()->getKeyName();
            $pk = JFactory::getApplication()->input->getInt($key);
            if($pk) {
                $item->containerslist = $this->getRelatedModel('containerslist')->getContainersInRequest($pk);
                $item->examslist = $this->getRelatedModel('examslist')->getExamsInRequestByCategory($pk);
                $item->totalexams = count($this->getRelatedModel('examslist')->getExamsInRequest($pk));
            }
		}

		return $item;
	}

    /**
     * get model related
     *
     * @param string $name
     * @return JModelLegacy
     */
    private function getRelatedModel($name) {
        $model = JModelLegacy::getInstance($name,'LabgenevetModel');
        return $model;
    }

    /**
     * save data in table and table related
     *
     * @param array $data
     * @return bool|void
     */
    public function save($data)
    {
        $application = JFactory::getApplication();
        $input = JFactory::getApplication()->input;
        $inputArray = $input->post->getArray();
        $jformArray = $inputArray['jform'];

        $this->getRelatedModel('Animal')->save($data['animals']);
        $this->getRelatedModel('Containerslist')->save($data['id'], $data['containerslist']);
        $examsListCategory = $jformArray['examslist'];
        $examsList = array();
        foreach($examsListCategory as $category => $exams) {
            foreach($exams as $exam) {
                array_push($examsList, $exam);
            }
        }
		$data['total'] = $this->getRelatedModel('Exams')->getTotalPrice($examsList);
        $data['totalexams'] = count($examsList);
        $this->getRelatedModel('Examslist')->save($data['id'], $examsList);

        // upload
        $files = $input->files->get('jform');
        //var_dump($files); exit;
        $fileinfo = pathinfo($files['result']['name']);
        $ext = $fileinfo['extension'];
        $filename = $data['id'].'_'.time().".$ext";
        $tmp_file = $files['result']['tmp_name'];
        $dest = JPATH_SITE."/media/com_labgenevet/upload/".$filename;
        $data['filename'] = $filename;
        if (JFile::upload($tmp_file, $dest)) {
            //$application->enqueueMessage(JText::_('FILE_UPLOAD_SUCESS'));
        } else {
            //$application->enqueueMessage(JText::_('FILE_UPLOAD_ERROR'), 'error');
        }

        return parent::save($data);
    }
}

