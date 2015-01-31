<?php

/**
 * Book form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBookForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'      => new sfWidgetFormInputHidden(),
      'isbn13'      => new sfWidgetFormInput(),
      'title'       => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'imagepath'   => new sfWidgetFormTextarea(),
      'published'   => new sfWidgetFormDateTime(),
    ));

    $this->setValidators(array(
      'isbn10'      => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'isbn10', 'required' => false)),
      'isbn13'      => new sfValidatorInteger(array('required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'description' => new sfValidatorString(array('required' => false)),
      'imagepath'   => new sfValidatorString(array('required' => false)),
      'published'   => new sfValidatorDateTime(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('book[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Book';
  }


}
