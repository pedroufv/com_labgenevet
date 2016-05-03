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

class LabgenevetFrontendHelper
{
	
	/**
	* Get category name using category ID
	* @param integer $category_id Category ID
	* @return mixed category name if the category was found, null otherwise
	*/
	public static function getCategoryNameByCategoryId($category_id)
	{
		$db = JFactory::getDbo();
		$query = $db->getQuery(true);

		$query
			->select('title')
			->from('#__categories')
			->where('id = ' . intval($category_id));

		$db->setQuery($query);
		return $db->loadResult();
	}

	/**
	 * Get an instance of the named model
	 *
	 * @param string $name
	 *
	 * @return null|object
	 */
	public static function getModel($name)
	{
		$model = null;

		// If the file exists, let's
		if (file_exists(JPATH_SITE . '/components/com_labgenevet/models/' . strtolower($name) . '.php'))
		{
			require_once JPATH_SITE . '/components/com_labgenevet/models/' . strtolower($name) . '.php';
			$model = JModelLegacy::getInstance($name, 'LabgenevetModel');
		}

		return $model;
	}

	/**
	 * get user data stored in cck custom fields
	 * @return mixed
	 */
	public static function getCckStoreFormUser($userId = null)
	{
		if(empty($userId)) {
			$user = JFactory::getUser();
			$userId = $user->get('id');
		}

		if(!$userId) {
			return false;
		} else {
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
				echo "<div class='alert'>Não foi possivel carregar as informções adicionais do usuário.</div>";
				return false;
			}
		}
	}
}
