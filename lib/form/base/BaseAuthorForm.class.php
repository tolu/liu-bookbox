<?php

/**
 * Author form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseAuthorForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10' => new sfWidgetFormInputHidden(),
      'name'   => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'isbn10' => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'isbn10', 'required' => false)),
      'name'   => new sfValidatorPropelChoice(array('model' => 'Author', 'column' => 'name', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('author[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Author';
  }


}
