<?php

/**
 * Tags form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseTagsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'     => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'tag_name'   => new sfWidgetFormInput(),
      'created_on' => new sfWidgetFormDateTime(),
      'id'         => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'isbn10'     => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'isbn10', 'required' => false)),
      'tag_name'   => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_on' => new sfValidatorDateTime(array('required' => false)),
      'id'         => new sfValidatorPropelChoice(array('model' => 'Tags', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('tags[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags';
  }


}
