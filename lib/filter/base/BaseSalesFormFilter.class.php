<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Sales filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSalesFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'    => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'buyer_id'  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'seller_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'added_on'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'sold_on'   => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'price'     => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'isbn10'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Book', 'column' => 'isbn10')),
      'buyer_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'seller_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'added_on'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'sold_on'   => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'price'     => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('sales_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sales';
  }

  public function getFields()
  {
    return array(
      'id'        => 'Number',
      'isbn10'    => 'ForeignKey',
      'buyer_id'  => 'ForeignKey',
      'seller_id' => 'ForeignKey',
      'added_on'  => 'Date',
      'sold_on'   => 'Date',
      'price'     => 'Number',
    );
  }
}
