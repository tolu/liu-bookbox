<?php

/**
 * Courses form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCoursesForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'course_name' => new sfWidgetFormInput(),
      'course_year' => new sfWidgetFormInput(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Courses', 'column' => 'id', 'required' => false)),
      'course_name' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'course_year' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('courses[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Courses';
  }


}
