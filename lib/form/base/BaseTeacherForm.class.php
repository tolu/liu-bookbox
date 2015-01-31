<?php

/**
 * Teacher form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseTeacherForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'teacher_id'  => new sfWidgetFormPropelChoice(array('model' => 'Teacher', 'add_empty' => true)),
      'institution' => new sfWidgetFormInput(),
      'id'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'teacher_id'  => new sfValidatorPropelChoice(array('model' => 'Teacher', 'column' => 'id', 'required' => false)),
      'institution' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id'          => new sfValidatorPropelChoice(array('model' => 'Teacher', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('teacher[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Teacher';
  }


}
