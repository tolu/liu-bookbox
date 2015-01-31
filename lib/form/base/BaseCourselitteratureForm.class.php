<?php

/**
 * Courselitterature form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCourselitteratureForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'      => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'course_code' => new sfWidgetFormPropelChoice(array('model' => 'Courses', 'add_empty' => true)),
      'id'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'isbn10'      => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'isbn10', 'required' => false)),
      'course_code' => new sfValidatorPropelChoice(array('model' => 'Courses', 'column' => 'id', 'required' => false)),
      'id'          => new sfValidatorPropelChoice(array('model' => 'Courselitterature', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('courselitterature[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Courselitterature';
  }


}
