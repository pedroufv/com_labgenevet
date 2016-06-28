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

// Import CSS
$document = JFactory::getDocument();
$document->addStyleSheet('components/com_labgenevet/assets/css/labgenevet.css');
?>
<script type="text/javascript">
    js = jQuery.noConflict();

    Joomla.submitbutton = function (task) {
        if (task == 'request.cancel') {
            Joomla.submitform(task, document.getElementById('request-form'));
        }
        else {

            if (task != 'request.cancel' && document.formvalidator.isValid(document.id('request-form'))) {

                Joomla.submitform(task, document.getElementById('request-form'));
            }
            else {
                alert('<?php echo $this->escape(JText::_('JGLOBAL_VALIDATION_FORM_FAILED')); ?>');
            }
        }
    }
</script>
<form action="<?php echo JRoute::_('index.php?option=com_labgenevet&layout=edit&id=' . (int)$this->item->id); ?>" method="post" enctype="multipart/form-data" name="adminForm" id="request-form" class="form-validate">
    <div class="form-horizontal">
        <?php echo JHtml::_('bootstrap.startTabSet', 'myTab', array('active' => 'general')); ?>
        <?php echo JHtml::_('bootstrap.addTab', 'myTab', 'general', JText::_('COM_LABGENEVET_REQUEST', true)); ?>
        <div class="row-fluid">
            <div class="span12 form-horizontal">
                <fieldset class="adminform">
                    <input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>"/>
                    <?php echo $this->form->getInput('id', 'animals'); ?>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('name', 'animals'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('name', 'animals'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('age', 'animals'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('age', 'animals'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('gender', 'animals'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('gender', 'animals'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('species', 'animals'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('species', 'animals'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('breed', 'animals'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('breed', 'animals'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('owner', 'animals'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('owner', 'animals'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('urgent'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('urgent'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('internal_code'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('internal_code'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('created'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('created'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('situationsid'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('situationsid'); ?></div>
                    </div>
                    <div class="span4 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('created_by'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('created_by'); ?></div>
                    </div>
                    <div class="span12 control-group">
                        <div class="control-label"><?php echo $this->form->getLabel('containerslist'); ?></div>
                        <div class="controls"><?php echo $this->form->getInput('containerslist'); ?></div>
                    </div>
                    <div class="span12 control-group">
                        <div class="span10">
                            <div class="control-label"><?php echo $this->form->getLabel('result'); ?></div>
                            <div class="controls"><?php echo $this->form->getInput('result'); ?></div>
                        </div>
                        <?php if(!empty($this->item->filename) AND file_exists(JPATH_SITE."/media/com_labgenevet/upload/".$this->item->filename)): ?>
                        <div class="span2">
                            <a href="<?php echo JURI::base()."../media/com_labgenevet/upload/".$this->item->filename; ?>" target="_blank">
                                <?php echo JText::_('COM_LABGENEVET_SHOW_RESULT'); ?>
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="span12 control-group">
                    <?php foreach($this->form->getGroup('examslist') as $field): ?>
                        <div class="span4 control-group">
                            <div class="exam-category"><?php echo $field->label; ?></div>
                            <div class="exam-checkboxes"><?php echo $field->input; ?></div>
                        </div>
                    <?php endforeach; ?>
                    </div>
                    <input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>"/>
                    <input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>"/>
                    <input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>"/>
                    <?php if (empty($this->item->created_by)) { ?>
                        <input type="hidden" name="jform[created_by]" value="<?php echo JFactory::getUser()->id; ?>"/>
                    <?php } else { ?>
                        <input type="hidden" name="jform[created_by]" value="<?php echo $this->item->created_by; ?>"/>
                    <?php } ?>
                </fieldset>
            </div>
        </div>
        <?php echo JHtml::_('bootstrap.endTab'); ?>
        <?php echo JHtml::_('bootstrap.endTabSet'); ?>
        <input type="hidden" name="task" value=""/>
        <?php echo JHtml::_('form.token'); ?>
    </div>
</form>
