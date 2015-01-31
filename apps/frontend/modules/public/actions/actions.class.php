<?php

/**
 * public actions.
 *
 * @package    switcharoo
 * @subpackage public
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class publicActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
  	$this->message = $request->getParameter('msg');
  	
    $this->alertClass = 'ui-state-error';
  	$this->newUserCreated = false;
    
    //kolla om variabler från insertUser har skickats med...
    $hash = $request->getParameter('hash');
    $recipient = $request->getParameter('recipient');
    
    //isf. lämna lite info till användaren och skapa variabler för att skicka mail till den nya användaren
    if(isset($hash) && isset($recipient) )
    {
      $this->alertClass = 'ui-state-default';
      $this->newUserCreated = true;
      
      //hämta anv.namn och email
      $tmp = explode('_', $recipient);
      
      $this->email = $tmp[0];
      $this->userName = $tmp[1];
      $this->htmlMsg = '<h3>Välkommen till BookBox '.$tmp[1].'!</h3><p>För att aktivera ditt konto på bookbox behöver du klicka på nedstående länk:</p><a href="www.presponse.se/theWebsite/web/shared/activateUser?hash='.$hash.'">Aktivera konto</a><h5>Vi ses på bookbox!</h5>';
    }
    
  }
  
  public function executeLogin(sfWebRequest $request)
  {
  	
  	$userName = $request->getParameter('username');
    $password = $request->getParameter('pass');
    
    $c = new Criteria();
    
    if(isset($userName) && isset($password) )
    {
      $c->add(UserPeer::EMAIL, $userName);
      $c->add(UserPeer::PASSWORD, md5($password));
    }
 	
    $myUser = UserPeer::doSelectOne($c);
    
    if (count($myUser) > 0)
    {
      //control that user has been activated
      if($myUser->getIsActive() == 1)
      {
        $this->getUser()->setAttribute('loggedInId', $myUser->getId() );
        $this->getUser()->setAttribute('name', $myUser->getFname()." ".$myUser->getLname());
        $this->getUser()->setAttribute('credential', $myUser->getCredentials());
        
        $this->getUser()->setAuthenticated(true);
        $this->getUser()->addCredential($myUser->getCredentials());
        
        //set last login as of now
        $myUser->setLastLogin(date('U'));
        $myUser->save();
        
        $this->redirect($myUser->getCredentials()."/index");
      }

      $msg = 'Användaren med detta användarnamn och lösenord har ännu inte aktiverats...';
      $this->redirect('public/index?msg='.$msg);
      
    }

    //if login info was incorrect
    $msg = 'Hittade inte användare med det lösenordet / användarnamnet...';
    $this->redirect('public/index?msg='.$msg);
  }
 
  public function executeLogout()
  {
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->shutdown();
    $this->getUser()->setAttribute('credential', "");
    $this->getUser()->setAttribute('name', "");
    
    $this->redirect('public/index');
  }

  
  public function executeAddUser($request)
  {	
		$this->userName =  $this->getUser()->getAttribute('name');

	    $this->form = new UserForm();
	 
	 /*   if ($request->isMethod('post'))
	    {
	      $this->form->bind($request->getParameter('user'));
	      if ($this->form->isValid())
	      {
	        echo "HEEEJ";//$this->redirect('contact/thankyou?'.http_build_query($this->form->getValues()));
	      }
	    }*/
  }
  
  
  public function executeSearch($request)
  {
    $this->forward('shared', 'search');
  }
  public function executeSearchFieldResult($request)
  {	
    // REFACTOR - already function in student, and shared (component)
  	$this->userType =$this->getUser()->getAttribute("credential");
  	$this->userName =  $this->getUser()->getAttribute('name'); 
  	
  	$isbn10  = $request->getParameter('isbn10');
  	$category  = $request->getParameter('category');
    $course  = $request->getParameter('course');
  	$title  = $request->getParameter('title');
  	$author  = $request->getParameter('title');
  	
  	$this->query = array('isbn10'=>$isbn10,'author'=>$author,'title'=>$title,'category'=>$category,'course'=>$course);
  }
}
