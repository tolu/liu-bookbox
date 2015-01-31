<?php

/**
 * Rating form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseRatingForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'type'       => new sfWidgetFormInput(),
      'type_id'    => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'total_sum'  => new sfWidgetFormInput(),
      'created_on' => new sfWidgetFormDateTime(),
      'id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'type'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'type_id'    => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'isbn10', 'required' => false)),
      'total_sum'  => new sfValidatorInteger(array('required' => false)),
      'created_on' => new sfValidatorDateTime(array('required' => false)),
      'id'         => new sfValidatorPropelChoice(array('model' => 'Rating', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('rating[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Rating';
  }


}
