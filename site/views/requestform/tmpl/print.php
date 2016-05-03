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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
JHtml::_('formbehavior.chosen', 'select');
JHtml::_('behavior.keepalive');
JHtml::_('behavior.modal');

// load cck user data
$cckUserData = LabgenevetFrontendHelper::getCckStoreFormUser();

$document = JFactory::getDocument();
$document->addStyleSheet('components/com_labgenevet/assets/css/labgenevet.css');
$document->addStyleSheet('components/com_labgenevet/assets/css/print.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();
    js(document).ready(function () {
        window.print();
    });
</script>
<form id="form-requeste" action="<?php echo JRoute::_('index.php?option=com_labgenevet&task=request.save'); ?>" method="post" class="form-validate form-horizontal" enctype="multipart/form-data">
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
            <?php $this->form->setFieldAttribute('name', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('name', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('name', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('age', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('age', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('age', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('gender', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('gender', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('gender', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('breed', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('breed', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('breed', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('species', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('species', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('species', 'animals'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('owner', 'readonly', 'true', 'animals'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('owner', 'animals'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('owner', 'animals'); ?></div>
        </div>
    </fieldset>
    <fieldset>
        <legend><?php echo JText::_('COM_LABGENEVET_MAIN'); ?></legend>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('urgent', 'disabled', 'true'); ?>
            <?php $this->form->setFieldAttribute('urgent', 'class', 'readonly'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('urgent'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('urgent'); ?></div>
        </div>
        <div class="control-group">
            <?php $this->form->setFieldAttribute('containerslist', 'readonly', 'true'); ?>
            <div class="control-label"><?php echo $this->form->getLabel('containerslist'); ?></div>
            <div class="controls"><?php echo $this->form->getInput('containerslist'); ?></div>
        </div>
    </fieldset>
    <?php if($exams = $this->form->getGroup('examslist')): ?>
        <fieldset>
            <legend><?php echo JText::_('COM_LABGENEVET_EXAMS'); ?></legend>
            <div class="control-group">
                <?php foreach($this->form->getGroup('examslist') as $field): ?>
                    <div class="control-group">
                        <?php $field->readonly = true; ?>
                        <div class="exam-category"><?php echo $field->label; ?></div>
                        <div class="exam-checkboxes"><?php echo $field->input; ?></div>
                    </div>
                <?php endforeach; ?>
            </div>
        </fieldset>
    <?php endif; ?>
</form>
