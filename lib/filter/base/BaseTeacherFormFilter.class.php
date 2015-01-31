<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Teacher filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseTeacherFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'teacher_id'  => new sfWidgetFormPropelChoice(array('model' => 'Teacher', 'add_empty' => true)),
      'institution' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'teacher_id'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Teacher', 'column' => 'id')),
      'institution' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('teacher_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Teacher';
  }

  public function getFields()
  {
    return array(
      'teacher_id'  => 'ForeignKey',
      'institution' => 'Text',
      'id'          => 'Number',
    );
  }
}
