<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Tags filter form base class.
 *
 * @package    sf_sandbox
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseTagsFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'isbn10'     => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'tag_name'   => new sfWidgetFormFilterInput(),
      'created_on' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => true)),
    ));

    $this->setValidators(array(
      'isbn10'     => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Book', 'column' => 'isbn10')),
      'tag_name'   => new sfValidatorPass(array('required' => false)),
      'created_on' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
    ));

    $this->widgetSchema->setNameFormat('tags_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Tags';
  }

  public function getFields()
  {
    return array(
      'isbn10'     => 'ForeignKey',
      'tag_name'   => 'Text',
      'created_on' => 'Date',
      'id'         => 'Number',
    );
  }
}
