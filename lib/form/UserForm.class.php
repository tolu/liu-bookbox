<?php

/**
 * User form.
 *
 * @package    sf_sandbox
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class UserForm extends BaseUserForm
{
  public function configure()
  {	
    $this->setWidgets(array(
      'Fname'    => new sfWidgetFormInput(),
      'Lname'   => new sfWidgetFormInput(),
      'email'   => new sfWidgetFormInput(),
      'phone'   => new sfWidgetFormInput(),
       'city'   => new sfWidgetFormInput(),
       'street'   => new sfWidgetFormInput(),
       'postalcode'   => new sfWidgetFormInput(),
       'pass'   => new sfWidgetFormInputPassword(),
       'repass'   => new sfWidgetFormInputPassword(),
    ));
    
    $this->widgetSchema->setLabels(array(
		'Fname'    	=> 'Förnamn',
      	'Lname'   	=> 'Efternamn',
      	'email'   	=> 'Email',
      	'phone'   	=> 'Telefon nr.',
       	'city'   	=> 'Stad',
       	'street'   	=> 'Gatuadress',
       	'postalcode'   => 'Postkod',
       	'pass'   => 'Lösenord',
       	'repass'   => 'Upprepa lösenord',
    ));
    
     
    $this->setValidators(array(
      'Fname'    	=> new sfValidatorString(array('required' => true,'min_length' => 2)),
      'Lname'    	=> new sfValidatorString(array('required' => true, 'min_length' => 2)),
      'email'   	=> new sfValidatorEmail(),
      'phone'   	=> new sfValidatorString(array('required' => false)),
      'city'  		=> new sfValidatorString(array('required' => true)),
      'street'   	=> new sfValidatorString(array('required' => true)),
      'postalcode'  => new sfValidatorString(array('required' => true)),
      'pass'   		=> new sfValidatorString(array('required' => true, 'min_length' => 4)),
      'repass'  	=> new sfValidatorString(array('required' => true, 'min_length' => 4)), 
    ));

  	
  }
}
