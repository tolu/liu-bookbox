<?php

/**
 * User form base class.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'fname'       => new sfWidgetFormInput(),
      'lname'       => new sfWidgetFormInput(),
      'city'        => new sfWidgetFormInput(),
      'street'      => new sfWidgetFormInput(),
      'postal_code' => new sfWidgetFormInput(),
      'email'       => new sfWidgetFormInput(),
      'phone'       => new sfWidgetFormInput(),
      'credentials' => new sfWidgetFormInput(),
      'created_on'  => new sfWidgetFormDateTime(),
      'last_login'  => new sfWidgetFormDateTime(),
      'password'    => new sfWidgetFormInput(),
      'image_path'  => new sfWidgetFormTextarea(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'fname'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'lname'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'city'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'street'      => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'postal_code' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'email'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'phone'       => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'credentials' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'created_on'  => new sfValidatorDateTime(array('required' => false)),
      'last_login'  => new sfValidatorDateTime(array('required' => false)),
      'password'    => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'image_path'  => new sfValidatorString(array('required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


}
