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
$cckUserData = LabgenevetHelper::getCckStoreFormUser($this->item->created_by);

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
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span12">
        <?php if($cckUserData) : ?>
            <fieldset>
                <legend><?php echo JText::_('COM_LABGENEVET_CCK_USER'); ?></legend>
                <?php if(!empty($cckUserData->razao_social)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_COMPANY_NAME'); ?>: </strong>
                    <span><?php echo $cckUserData->razao_social; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->cnpj)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_CNPJ'); ?>: </strong>
                    <span><?php echo $cckUserData->cnpj; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->insc_estaudual)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_STATE_REGISTRATION'); ?>: </strong>
                    <span><?php echo $cckUserData->insc_estaudual; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->telefone)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_PHONE'); ?>: </strong>
                    <span><?php echo $cckUserData->telefone; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->fax)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_FAX'); ?>: </strong>
                    <span><?php echo $cckUserData->fax; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->celular)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_CELL_PHONE'); ?>: </strong>
                    <span><?php echo $cckUserData->celular; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->endereco)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_ADDRESS'); ?>: </strong>
                    <span><?php echo $cckUserData->endereco; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->numero)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_NUMBER'); ?>: </strong>
                    <span><?php echo $cckUserData->numero; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->complemento)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_COMPLEMENT'); ?>: </strong>
                    <span><?php echo $cckUserData->complemento; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->cidade)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_CITY'); ?>: </strong>
                    <span><?php echo $cckUserData->cidade; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->estado)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_STATE'); ?>: </strong>
                    <span><?php echo $cckUserData->estado; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->cep)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_CEP'); ?>: </strong>
                    <span><?php echo $cckUserData->cep; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->pais)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_COUNTRY'); ?>: </strong>
                    <span><?php echo $cckUserData->pais; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->email_para_o_envio)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_MAIL_ENDING'); ?>: </strong>
                    <span><?php echo $cckUserData->email_para_o_envio; ?></span>
                </div>
                <?php endif; ?>
                <?php if(!empty($cckUserData->email_para_faturamento)): ?>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_MAIL_BILLING'); ?>: </strong>
                    <span><?php echo $cckUserData->email_para_faturamento; ?></span>
                </div>
                <?php endif; ?>
            </fieldset>
        <?php endif; ?>
            <fieldset>
                <legend><?php echo JText::_('COM_LABGENEVET_ANIMAL'); ?></legend>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_NAME'); ?>: </strong>
                    <span><?php echo $this->item->animals->name; ?></span>
                </div>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_AGE'); ?>: </strong>
                    <span><?php echo $this->item->animals->age; ?></span>
                </div>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_GENDER'); ?>: </strong>
                    <span><?php echo $this->form->getInput('gender', 'animals'); ?></span>
                </div>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_SPECIE'); ?>: </strong>
                    <span><?php echo $this->form->getInput('species', 'animals'); ?></span>
                </div>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_BREED'); ?>: </strong>
                    <span><?php echo $this->form->getInput('breed', 'animals'); ?></span>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_LABGENEVET_MAIN'); ?></legend>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_URGENT'); ?>: </strong>
                    <span><?php echo $this->form->getInput('urgent'); ?></span>
                </div>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_CREATED'); ?>: </strong>
                    <span><?php echo $this->form->getInput('created'); ?></span>
                </div>
                <div class="span4">
                    <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_SITUATION'); ?>: </strong>
                    <span><?php echo $this->form->getInput('situationsid'); ?></span>
                </div>
                <div class="span12">
                    <strong><?php echo JText::_('COM_LABGENEVET_CONTAINERS'); ?></strong>
                    <div class="controls"><?php echo $this->form->getInput('containerslist'); ?></div>
                </div>
            </fieldset>
            <fieldset>
                <legend><?php echo JText::_('COM_LABGENEVET_EXAMS'); ?></legend>
                <div class="span12 control-group">
                    <?php foreach($this->form->getGroup('examslist') as $field): ?>
                        <div class="span4 control-group">
                            <div class="exam-category"><?php echo $field->label; ?></div>
                            <div class="exam-checkboxes"><?php echo $field->input; ?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </fieldset>
        </div>
    </div>
</div>
