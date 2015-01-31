<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Books filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBooksFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'         => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'seller_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'bookquality'    => new sfWidgetFormFilterInput(),
      'added_on'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'price'          => new sfWidgetFormFilterInput(),
      'is_checked_out' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'isbn10'         => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Book', 'column' => 'isbn10')),
      'seller_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'bookquality'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'added_on'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'price'          => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'is_checked_out' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('books_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Books';
  }

  public function getFields()
  {
    return array(
      'id'             => 'Number',
      'isbn10'         => 'ForeignKey',
      'seller_id'      => 'ForeignKey',
      'bookquality'    => 'Number',
      'added_on'       => 'Date',
      'price'          => 'Number',
      'is_checked_out' => 'Date',
    );
  }
}
