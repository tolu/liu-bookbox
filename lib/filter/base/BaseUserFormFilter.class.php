<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * User filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'fname'       => new sfWidgetFormFilterInput(),
      'lname'       => new sfWidgetFormFilterInput(),
      'city'        => new sfWidgetFormFilterInput(),
      'street'      => new sfWidgetFormFilterInput(),
      'postal_code' => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'phone'       => new sfWidgetFormFilterInput(),
      'credentials' => new sfWidgetFormFilterInput(),
      'created_on'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'last_login'  => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
      'password'    => new sfWidgetFormFilterInput(),
      'image_path'  => new sfWidgetFormFilterInput(),
      'is_active'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
    ));

    $this->setValidators(array(
      'fname'       => new sfValidatorPass(array('required' => false)),
      'lname'       => new sfValidatorPass(array('required' => false)),
      'city'        => new sfValidatorPass(array('required' => false)),
      'street'      => new sfValidatorPass(array('required' => false)),
      'postal_code' => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'phone'       => new sfValidatorPass(array('required' => false)),
      'credentials' => new sfValidatorPass(array('required' => false)),
      'created_on'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'last_login'  => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'password'    => new sfValidatorPass(array('required' => false)),
      'image_path'  => new sfValidatorPass(array('required' => false)),
      'is_active'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'fname'       => 'Text',
      'lname'       => 'Text',
      'city'        => 'Text',
      'street'      => 'Text',
      'postal_code' => 'Text',
      'email'       => 'Text',
      'phone'       => 'Text',
      'credentials' => 'Text',
      'created_on'  => 'Date',
      'last_login'  => 'Date',
      'password'    => 'Text',
      'image_path'  => 'Text',
      'is_active'   => 'Boolean',
    );
  }
}
