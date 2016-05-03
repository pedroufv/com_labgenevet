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

// load cck user data
$cckUserData = LabgenevetFrontendHelper::getCckStoreFormUser();

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
<?php if($cckUserData) : ?>
<fieldset>
    <legend><?php echo JText::_('COM_LABGENEVET_CCK_USER'); ?></legend>
    <?php if(!empty($cckUserData->razao_social)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_COMPANY_NAME'); ?>: </strong>
        <span><?php echo $cckUserData->razao_social; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->cnpj)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_CNPJ'); ?>: </strong>
        <span><?php echo $cckUserData->cnpj; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->insc_estaudual)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_STATE_REGISTRATION'); ?>: </strong>
        <span><?php echo $cckUserData->insc_estaudual; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->telefone)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_PHONE'); ?>: </strong>
        <span><?php echo $cckUserData->telefone; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->fax)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_FAX'); ?>: </strong>
        <span><?php echo $cckUserData->fax; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->celular)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_CELL_PHONE'); ?>: </strong>
        <span><?php echo $cckUserData->celular; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->endereco)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_ADDRESS'); ?>: </strong>
        <span><?php echo $cckUserData->endereco; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->numero)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_NUMBER'); ?>: </strong>
        <span><?php echo $cckUserData->numero; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->complemento)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_COMPLEMENT'); ?>: </strong>
        <span><?php echo $cckUserData->complemento; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->cidade)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_CITY'); ?>: </strong>
        <span><?php echo $cckUserData->cidade; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->estado)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_STATE'); ?>: </strong>
        <span><?php echo $cckUserData->estado; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->cep)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_CEP'); ?>: </strong>
        <span><?php echo $cckUserData->cep; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->pais)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_COUNTRY'); ?>: </strong>
        <span><?php echo $cckUserData->pais; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->email_para_o_envio)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_MAIL_ENDING'); ?>: </strong>
        <span><?php echo $cckUserData->email_para_o_envio; ?></span>
    </div>
    <?php endif; ?>
    <?php if(!empty($cckUserData->email_para_faturamento)): ?>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_MAIL_BILLING'); ?>: </strong>
        <span><?php echo $cckUserData->email_para_faturamento; ?></span>
    </div>
    <?php endif; ?>
</fieldset>
<?php endif; ?>
<fieldset>
    <legend><?php echo JText::_('COM_LABGENEVET_ANIMAL'); ?></legend>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_NAME'); ?>: </strong>
        <span><?php echo $this->item->animals->name; ?></span>
    </div>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_AGE'); ?>: </strong>
        <span><?php echo $this->item->animals->age; ?></span>
    </div>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_GENDER'); ?>: </strong>
        <?php $this->form->setFieldAttribute('gender', 'readonly', 'true', 'animals'); ?>
        <span><?php echo $this->form->getInput('gender', 'animals'); ?></span>
    </div>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_SPECIE'); ?>: </strong>
        <?php $this->form->setFieldAttribute('species', 'readonly', 'true', 'animals'); ?>
        <span><?php echo $this->form->getInput('species', 'animals'); ?></span>
    </div>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_BREED'); ?>: </strong>
        <?php $this->form->setFieldAttribute('breed', 'readonly', 'true', 'animals'); ?>
        <span><?php echo $this->form->getInput('breed', 'animals'); ?></span>
    </div>
    <div class="span5 control-group">
            <strong><?php echo $this->form->getLabel('owner', 'animals'); ?></strong>
            <?php $this->form->setFieldAttribute('owner', 'readonly', 'true', 'animals'); ?>
            <span><?php echo $this->form->getInput('owner', 'animals'); ?></span>
        </div>
</fieldset>
<fieldset>
    <legend><?php echo JText::_('COM_LABGENEVET_MAIN'); ?></legend>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_URGENT'); ?>: </strong>
        <?php $this->form->setFieldAttribute('urgent', 'disabled', 'true'); ?>
        <?php $this->form->setFieldAttribute('urgent', 'class', 'readonly'); ?>
        <span><?php echo $this->form->getInput('urgent'); ?></span>
    </div>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_CREATED'); ?>: </strong>
        <?php $this->form->setFieldAttribute('created', 'readonly', 'true'); ?>
        <span><?php echo $this->form->getInput('created'); ?></span>
    </div>
    <div class="span5 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_FORM_LBL_SITUATION'); ?>: </strong>
        <?php $this->form->setFieldAttribute('situationsid', 'readonly', 'true'); ?>
        <span><?php echo $this->form->getInput('situationsid'); ?></span>
    </div>
    <div class="span12 control-group">
        <strong><?php echo JText::_('COM_LABGENEVET_CONTAINERS'); ?></strong>
        <?php $this->form->setFieldAttribute('containerslist', 'readonly', 'true'); ?>
        <div class="controls"><?php echo $this->form->getInput('containerslist'); ?></div>
    </div>
</fieldset>
<fieldset>
    <legend><?php echo JText::_('COM_LABGENEVET_EXAMS'); ?></legend>
    <div class="span12 control-group">
        <?php foreach($this->form->getGroup('examslist') as $field): ?>
            <div class="span5 control-group">
                <div class="exam-category"><?php echo $field->label; ?></div>
                <?php $field->readonly = true; ?>
                <div class="exam-checkboxes"><?php echo $field->input; ?></div>
            </div>
        <?php endforeach; ?>
    </div>
</fieldset>
<fieldset>
    <div class="control-group">
        <div class="controls">
            <a class="btn" href="<?php echo JRoute::_('index.php?option=com_labgenevet&task=requestform.cancel'); ?>" title="<?php echo JText::_('JCANCEL'); ?>"><?php echo JText::_('JCANCEL'); ?></a>
        </div>
    </div>
    <input type="hidden" name="option" value="com_labgenevet" />
    <input type="hidden" name="task" value="request.save" />
    <?php echo JHtml::_('form.token'); ?>
</fieldset>
