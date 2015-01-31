<?php

/**
 * Booksforsale form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBooksforsaleForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'             => new sfWidgetFormInputHidden(),
      'isbn10'         => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'seller_id'      => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'bookquality'    => new sfWidgetFormInput(),
      'added_on'       => new sfWidgetFormDateTime(),
      'price'          => new sfWidgetFormInput(),
      'is_checked_out' => new sfWidgetFormDateTime(),
      'checked_out_by' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'             => new sfValidatorPropelChoice(array('model' => 'Booksforsale', 'column' => 'id', 'required' => false)),
      'isbn10'         => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'isbn10', 'required' => false)),
      'seller_id'      => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'bookquality'    => new sfValidatorInteger(array('required' => false)),
      'added_on'       => new sfValidatorDateTime(array('required' => false)),
      'price'          => new sfValidatorNumber(array('required' => false)),
      'is_checked_out' => new sfValidatorDateTime(array('required' => false)),
      'checked_out_by' => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('booksforsale[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Booksforsale';
  }


}
