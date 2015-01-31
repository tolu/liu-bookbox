<?php

/**
 * Sales form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseSalesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'        => new sfWidgetFormInputHidden(),
      'isbn10'    => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'buyer_id'  => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'seller_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'added_on'  => new sfWidgetFormDateTime(),
      'sold_on'   => new sfWidgetFormDateTime(),
      'price'     => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'        => new sfValidatorPropelChoice(array('model' => 'Sales', 'column' => 'id', 'required' => false)),
      'isbn10'    => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'isbn10', 'required' => false)),
      'buyer_id'  => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'seller_id' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'added_on'  => new sfValidatorDateTime(array('required' => false)),
      'sold_on'   => new sfValidatorDateTime(array('required' => false)),
      'price'     => new sfValidatorNumber(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('sales[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Sales';
  }


}
