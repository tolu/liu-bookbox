<?php

/**
 * Courses form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class CoursesForm extends BaseCoursesForm
{
  public function configure()
  {	
    $this->setWidgets(array(
      'courseId'    => new sfWidgetFormInput(),
      'courseName'    => new sfWidgetFormInput(),
      'courseYear'   => new sfWidgetFormInput(),

    ));
  	
  }
}
