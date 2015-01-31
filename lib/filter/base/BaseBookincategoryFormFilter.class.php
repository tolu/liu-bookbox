<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Bookincategory filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBookincategoryFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'      => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'isbn10'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Book', 'column' => 'isbn10')),
      'category_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Category', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('bookincategory_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bookincategory';
  }

  public function getFields()
  {
    return array(
      'isbn10'      => 'ForeignKey',
      'category_id' => 'ForeignKey',
      'id'          => 'Number',
    );
  }
}
