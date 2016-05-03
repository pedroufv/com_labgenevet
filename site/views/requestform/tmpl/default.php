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

JHtml::_('behavior.keepalive');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');

// load user
$user = JFactory::getUser();
$userId = $user->get('id');
// load cck user data
$cckUserData = LabgenevetFrontendHelper::getCckStoreFormUser();
$cckUserData = false;
//Load language file
$lang = JFactory::getLanguage();
$lang->load('com_labgenevet', JPATH_SITE);
$doc = JFactory::getDocument();
$doc->addScript(JUri::base() . '/components/com_labgenevet/assets/js/form.js');
$doc->addStyleSheet(JUri::base() . '/components/com_labgenevet/assets/css/labgenevet.css');

?>
<script type="text/javascript">
    if (jQuery === 'undefined') {
        document.addEventListener("DOMContentLoaded", function (event) {
            jQuery('#form-request').submit(function (event) {

            });
        });
    } else {
        jQuery(document).ready(function () {
            jQuery('#form-request').submit(function (event) {

            });
        });
    }
</script>
<h1><?php echo JText::_('COM_LABGENEVET_ITEM_ADD'); ?></h1>
<form id="form-request" action="<?php echo JRoute::_('index.php?option=com_labgenevet&task=requestform.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
    <?php if($cckUserData) : ?>
        <fieldset>
            <legend><?php echo JText::_('COM_LABGENEVET_CCK_USER'); ?></legend>
            <?php if(!empty($cckUserData->razao_social)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_COMPANY_NAME'); ?></div>
                    <div class="controls"><?php echo $cckUserData->razao_social; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->cnpj)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_CNPJ'); ?></div>
                    <div class="controls"><?php echo $cckUserData->cnpj; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->insc_estaudual)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_STATE_REGISTRATION'); ?></div>
                    <div class="controls"><?php echo $cckUserData->insc_estaudual; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->telefone)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_PHONE'); ?></div>
                    <div class="controls"><?php echo $cckUserData->telefone; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->fax)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_FAX'); ?></div>
                    <div class="controls"><?php echo $cckUserData->fax; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->celular)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_CELL_PHONE'); ?></div>
                    <div class="controls"><?php echo $cckUserData->celular; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->endereco)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_ADDRESS'); ?></div>
                    <div class="controls"><?php echo $cckUserData->endereco; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->numero)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_NUMBER'); ?></div>
                    <div class="controls"><?php echo $cckUserData->numero; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->complemento)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_COMPLEMENT'); ?></div>
                    <div class="controls"><?php echo $cckUserData->complemento; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->cidade)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_CITY'); ?></div>
                    <div class="controls"><?php echo $cckUserData->cidade; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->estado)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_STATE'); ?></div>
                    <div class="controls"><?php echo $cckUserData->estado; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->cep)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_CEP'); ?></div>
                    <div class="controls"><?php echo $cckUserData->cep; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->pais)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_COUNTRY'); ?></div>
                    <div class="controls"><?php echo $cckUserData->pais; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->email_para_o_envio)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_MAIL_ENDING'); ?></div>
                    <div class="controls"><?php echo $cckUserData->email_para_o_envio; ?></div>
                </div>
            <?php endif; ?>
            <?php if(!empty($cckUserData->email_para_faturamento)): ?>
                <div class="control-group">
                    <div class="control-label"><?php echo JText::_('COM_LABGENEVET_MAIL_BILLING'); ?></div>
                    <div class="controls"><?php echo $cckUserData->email_para_faturamento; ?></div>
                </div>
            <?php endif; ?>
        </fieldset>
    <?php endif; ?>
    <fieldset>
        <legend><?php echo JText::_('COM_LABGENEVET_ANIMAL'); ?></legend>
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('name', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('name', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('age', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('age', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('gender', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('gender', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('species', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('species', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('breed', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('breed', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('owner', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('owner', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <div class="control-label"><?php echo JText::_('COM_LABGENEVET_FORM_LBL_CREATED_BY'); ?></div>
            <div class="controls"><?php echo $user->get('name'); ?></div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo JText::_('COM_LABGENEVET_MAIN'); ?></legend>
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('info'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('info'); ?></div>
        </div>
        <div class="control-group">
            <div class="span1 control-label"><?php echo $this->form->getLabel('urgent'); ?></div>
            <div class="span2 controls"><?php echo $this->form->getInput('urgent'); ?></div>
        </div>
        <div class="control-group">
            <div class="control-label"><?php echo $this->form->getLabel('containerslist'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('containerslist'); ?></div>
        </div>
    </fieldset>
    <?php if($exams = $this->form->getGroup('examslist')): ?>
        <fieldset>
            <legend><?php echo JText::_('COM_LABGENEVET_EXAMS'); ?></legend>
            <div class="control-group">
                <?php foreach($exams as $field): ?>
                    <div class="control-group">
                        <div class="exam-category"><?php echo $field->label; ?></div>
                        <div class="exam-checkboxes"><?php echo $field->input; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </fieldset>
    <?php endif; ?>
    <fieldset>
        <div class="control-group">
            <div class="controls">
                <button type="submit" class="validate btn btn-primary"><?php echo JText::_('JSUBMIT'); ?></button>
                <a class="btn" href="<?php echo JRoute::_('index.php?option=com_labgenevet&task=requestform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
            </div>
        </div>
        <input type="hidden" name="option" value="com_labgenevet" />
        <input type="hidden" name="task" value="requestform.save" />
        <?php echo JHtml::_('form.token'); ?>
    </fieldset>
</form>
