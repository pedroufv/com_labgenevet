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

require_once JPATH_COMPONENT . '/controller.php';

/**
 * Exame controller class.
 */
class LabgenevetControllerRequestform extends LabgenevetController
{
	/**
	 * Method to save a user's profile data.
	 * @return bool
	 * @throws Exception
	 * @since    1.6
	 */
	public function save()
	{
		// Check for request forgeries.
		JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

		// Initialise variables.
		$app   = JFactory::getApplication();
		$model = $this->getModel('Requestform', 'LabgenevetModel');

		// Get the user data.
		$data = JFactory::getApplication()->input->get('jform', array(), 'array');

		// Validate the posted data.
		$form = $model->getForm();
		if (!$form)
		{
			throw new Exception($model->getError(), 500);
		}

		// Validate the posted data.
		$data = $model->validate($form, $data);

		// Check for errors.
		if ($data === false)
		{
			// Get the validation messages.
			$errors = $model->getErrors();

			// Push up to three validation messages out to the user.
			for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++)
			{
				if ($errors[ $i ] instanceof Exception)
				{
					$app->enqueueMessage($errors[ $i ]->getMessage(), 'warning');
				}
				else
				{
					$app->enqueueMessage($errors[ $i ], 'warning');
				}
			}

			$input = $app->input;
			$jform = $input->get('jform', array(), 'ARRAY');

			// Save the data in the session.
			$app->setUserState('com_labgenevet.edit.requestform.data', $jform, array());

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_labgenevet.edit.request.id');
			$this->setRedirect(JRoute::_('index.php?option=com_labgenevet&view=requestform&layout=edit&id=' . $id, false));

			return false;
		}

		// Attempt to save the data.
		$return = $model->save($data);

		// Check for errors.
		if ($return === false)
		{
			// Save the data in the session.
			$app->setUserState('com_labgenevet.edit.requestform.data', $data);

			// Redirect back to the edit screen.
			$id = (int) $app->getUserState('com_labgenevet.edit.requestform.id');
			$this->setMessage(JText::sprintf('Save failed', $model->getError()), 'warning');
			$this->setRedirect(JRoute::_('index.php?option=com_labgenevet&view=requestform&layout=edit&id=' . $id, false));

			return false;
		}

		if ($return)
		{
			// Redirect to the list screen.
			$this->setMessage(JText::_('COM_LABGENEVET_ITEM_SAVED_SUCCESSFULLY'));
			$this->setRedirect(JRoute::_('index.php?option=com_labgenevet&view=requests', false));
		}
	}

    /**
     * redirect to list
     * @return void
     */
	public function cancel()
	{
		$this->setRedirect(JRoute::_('index.php?option=com_labgenevet&view=requests', false));
	}
}
