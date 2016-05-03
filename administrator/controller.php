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

class LabgenevetController extends JControllerLegacy
{
    /**
     * The default view.
     *
     * @var     string
     * @since   3.2
     */
    protected $default_view = 'requests';

    /**
     * Method to display a view.
     *
     * @param	boolean			$cachable	If true, the view output will be cached
     * @param	array			$urlparams	An array of safe url parameters and their variable types, for valid values see {@link JFilterInput::clean()}.
     *
     * @return	JController		This object to support chaining.
     * @since	1.5
     */
    public function display($cachable = false, $urlparams = false)
    {
        // Set the default view name and format from the Request.
        $this->input->get('view', $this->default_view);

        parent::display($cachable, $urlparams);

        return $this;
    }

    public function populateBreeds()
    {
        $inputArray = $this->input->post->getArray();
        $model = JModelLegacy::getInstance('Breeds','LabgenevetModel');
        $breeds = $model->getBreedsInSpecie($inputArray['specie']);

        echo json_encode($breeds);

        jexit();
    }
}
