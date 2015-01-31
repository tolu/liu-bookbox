<?php

/**
 * Bookincategory form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBookincategoryForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'      => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'category_id' => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'id'          => new sfWidgetFormInputHidden(),
    ));

    $this->setValidators(array(
      'isbn10'      => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'isbn10', 'required' => false)),
      'category_id' => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id', 'required' => false)),
      'id'          => new sfValidatorPropelChoice(array('model' => 'Bookincategory', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('bookincategory[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Bookincategory';
  }


}
