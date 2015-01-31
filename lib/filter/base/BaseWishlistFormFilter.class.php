<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Wishlist filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseWishlistFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'  => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'user_id' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'isbn10'  => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Book', 'column' => 'isbn10')),
      'user_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('wishlist_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wishlist';
  }

  public function getFields()
  {
    return array(
      'isbn10'  => 'ForeignKey',
      'user_id' => 'ForeignKey',
      'id'      => 'Number',
    );
  }
}
