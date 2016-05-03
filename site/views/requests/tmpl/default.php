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

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('bootstrap.tooltip');
JHtml::_('behavior.multiselect');
JHtml::_('formbehavior.chosen', 'select');

$user = JFactory::getUser();
$userId = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn = $this->state->get('list.direction');
$canCreate = $user->authorise('core.create', 'com_labgenevet');
?>

<form action="<?php echo JRoute::_('index.php?option=com_labgenevet&view=requests'); ?>" method="post" name="adminForm" id="adminForm">
    <?php if(count($this->items) > 0) : ?>
    <?php //echo JLayoutHelper::render('default_filter', array('view' => $this), dirname(__FILE__)); ?>
    <table class="table table-striped" id="requestList">
        <thead>
            <tr>
                <th width="1%" class="nowrap center hidden-phone">
                    <?php echo JHtml::_('grid.sort', 'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_LABGENEVET_ANIMAL', 'a.animalsid', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_LABGENEVET_OWNER', 'a.owner', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_LABGENEVET_CREATED', 'a.created', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_LABGENEVET_SITUATION', 'a.situationid', $listDirn, $listOrder); ?>
                </th>
                <th class=''>
                    <?php echo JHtml::_('grid.sort', 'COM_LABGENEVET_CHECKED_OUT_TIME', 'a.checked_out_time', $listDirn, $listOrder); ?>
                </th>
                <th class="center">
                    <?php echo JText::_('COM_LABGENEVET_ACTIONS'); ?>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
                    <?php echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
        <?php foreach ($this->items as $i => $item) : ?>
            <tr class="row<?php echo $i % 2; ?>">
                <td>
                    <?php echo (int)$item->id; ?>
                </td>
                <td>
                    <?php echo $item->animals->name; ?>
                </td>
                <td>
                    <?php echo $item->animals->owner; ?>
                </td>
                <td>
                    <?php echo $item->created; ?>
                </td>
                <td>
                    <?php echo $item->situationsid; ?>
                </td>
                <td>
                <?php if($item->checked_out_time == '0000-00-00 00:00:00'): ?>
                    <?php echo JText::_('COM_LABGENEVET_NOT_CHECKED'); ?>
                <?php else: ?>
                    <?php echo $item->checked_out_time; ?>
                <?php endif; ?>
                </td>
                <td class="center">
                    <a href="<?php echo JRoute::_('index.php?option=com_labgenevet&task=requestform&layout=print&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-print"></i></a>
                    <a href="<?php echo JRoute::_('index.php?option=com_labgenevet&task=requestform&layout=report&id=' . $item->id, false, 2); ?>" class="btn btn-mini" type="button"><i class="icon-file-alt"></i></a>
                <?php if(!empty($item->filename) AND file_exists(JPATH_SITE."/media/com_labgenevet/upload/".$item->filename)): ?>
                    <a href="<?php echo JURI::base()."media/com_labgenevet/upload/".$item->filename; ?>" target="_blank" class="btn btn-mini" type="button"><i class="icon-paperclip"></i></a>
                <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="alert">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <?php echo JText::_('COM_LABGENEVET_RESULTS_NOT_FOUND'); ?>
        </div>
    <?php endif; ?>
    <a href="<?php echo JRoute::_('index.php?option=com_labgenevet&task=requestform', false, 2); ?>" class="btn btn-success btn-small">
        <i class="icon-plus"></i> <?php echo JText::_('COM_LABGENEVET_ADD_ITEM'); ?>
    </a>
    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <input type="hidden" name="filter_order" value="<?php echo $listOrder; ?>"/>
    <input type="hidden" name="filter_order_Dir" value="<?php echo $listDirn; ?>"/>
    <?php echo JHtml::_('form.token'); ?>
</form>
