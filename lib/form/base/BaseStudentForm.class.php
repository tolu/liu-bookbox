<?php

/**
 * Student form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseStudentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'student_id' => new sfWidgetFormPropelChoice(array('model' => 'Student', 'add_empty' => true)),
      'programme'  => new sfWidgetFormInput(),
      'id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'student_id' => new sfValidatorPropelChoice(array('model' => 'Student', 'column' => 'id', 'required' => false)),
      'programme'  => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'id'         => new sfValidatorPropelChoice(array('model' => 'Student', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('student[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Student';
  }


}
