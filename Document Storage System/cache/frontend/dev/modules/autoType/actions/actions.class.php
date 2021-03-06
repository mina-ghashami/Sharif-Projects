<?php
// auto-generated by sfPropelAdmin
// date: 2009/09/15 07:09:15
?>
<?php

/**
 * autoType actions.
 *
 * @package    ##PROJECT_NAME##
 * @subpackage autoType
 * @author     Fabien Potencier <fabien.potencier@symfony-project.com>
 * @version    SVN: $Id: actions.class.php 9855 2008-06-25 11:26:01Z FabianLange $
 */
class autoTypeActions extends sfActions
{
  public function executeIndex()
  {
    return $this->forward('type', 'list');
  }

  public function executeList()
  {
    $this->processSort();

    $this->processFilters();


    // pager
    $this->pager = new sfPropelPager('Type', 10);
    $c = new Criteria();
    $this->addSortCriteria($c);
    $this->addFiltersCriteria($c);
    $this->pager->setCriteria($c);
    $this->pager->setPage($this->getRequestParameter('page', $this->getUser()->getAttribute('page', 1, 'sf_admin/type')));
    $this->pager->init();
    // save page
    if ($this->getRequestParameter('page')) {
        $this->getUser()->setAttribute('page', $this->getRequestParameter('page'), 'sf_admin/type');
    }
  }

  public function executeCreate()
  {
    return $this->forward('type', 'edit');
  }

  public function executeSave()
  {
    return $this->forward('type', 'edit');
  }

  public function executeEdit()
  {
    $this->type = $this->getTypeOrCreate();

    if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
      $this->updateTypeFromRequest();

      $this->saveType($this->type);

      $this->setFlash('notice', 'Your modifications have been saved');

      if ($this->getRequestParameter('save_and_add'))
      {
        return $this->redirect('type/create');
      }
      else if ($this->getRequestParameter('save_and_list'))
      {
        return $this->redirect('type/list');
      }
      else
      {
        return $this->redirect('type/edit?id='.$this->type->getId());
      }
    }
    else
    {
      $this->labels = $this->getLabels();
    }
  }

  public function executeDelete()
  {
    $this->type = TypePeer::retrieveByPk($this->getRequestParameter('id'));
    $this->forward404Unless($this->type);

    try
    {
      $this->deleteType($this->type);
    }
    catch (PropelException $e)
    {
      $this->getRequest()->setError('delete', 'Could not delete the selected Type. Make sure it does not have any associated items.');
      return $this->forward('type', 'list');
    }

    return $this->redirect('type/list');
  }

  public function handleErrorEdit()
  {
    $this->preExecute();
    $this->type = $this->getTypeOrCreate();
    $this->updateTypeFromRequest();

    $this->labels = $this->getLabels();

    return sfView::SUCCESS;
  }

  protected function saveType($type)
  {
    $type->save();

  }

  protected function deleteType($type)
  {
    $type->delete();
  }

  protected function updateTypeFromRequest()
  {
    $type = $this->getRequestParameter('type');

    if (isset($type['name']))
    {
      $this->type->setName($type['name']);
    }
  }

  protected function getTypeOrCreate($id = 'id')
  {
    if (!$this->getRequestParameter($id))
    {
      $type = new Type();
    }
    else
    {
      $type = TypePeer::retrieveByPk($this->getRequestParameter($id));

      $this->forward404Unless($type);
    }

    return $type;
  }

  protected function processFilters()
  {
  }

  protected function processSort()
  {
    if ($this->getRequestParameter('sort'))
    {
      $this->getUser()->setAttribute('sort', $this->getRequestParameter('sort'), 'sf_admin/type/sort');
      $this->getUser()->setAttribute('type', $this->getRequestParameter('type', 'asc'), 'sf_admin/type/sort');
    }

    if (!$this->getUser()->getAttribute('sort', null, 'sf_admin/type/sort'))
    {
    }
  }

  protected function addFiltersCriteria($c)
  {
  }

  protected function addSortCriteria($c)
  {
    if ($sort_column = $this->getUser()->getAttribute('sort', null, 'sf_admin/type/sort'))
    {
      $sort_column = TypePeer::translateFieldName($sort_column, BasePeer::TYPE_FIELDNAME, BasePeer::TYPE_COLNAME);
      if ($this->getUser()->getAttribute('type', null, 'sf_admin/type/sort') == 'asc')
      {
        $c->addAscendingOrderByColumn($sort_column);
      }
      else
      {
        $c->addDescendingOrderByColumn($sort_column);
      }
    }
  }

  protected function getLabels()
  {
    return array(
      'type{id}' => 'شماره:',
      'type{name}' => 'نام:',
    );
  }
}
