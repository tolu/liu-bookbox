<?php

/**
 * shared actions.
 *
 * @package    switcharoo
 * @subpackage shared
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class sharedActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('public/index');

  }
  
  public function executeSearch(sfWebRequest $request)
  {
    $this->userType = $this->getUser()->getAttribute("credential");
  	$this->userName = $this->getUser()->getAttribute("name");
    
    $course = $request->getParameter('course');
    $category = $request->getParameter('category');
    $author = $request->getParameter('author');
    
    //forward query to search function
    $this->query = array('course' => $course, 'category' => $category, 'author' => $author);
  }
  
  public function executeGetBookInfo(sfWebRequest $request)
  {
		//check if book is already in database
		$isbn = $request->getParameter('isbn');
    $edit = $request->getParameter('editable');
		$book = BookPeer::retrieveByPK($isbn);
		
		if ($book) //get info from database
		{
			//get book author(s)
			$c = new Criteria();
			$c->add(AuthorPeer::ISBN10, $isbn);
			$authors = AuthorPeer::doSelect($c);
			$bookAuthors = '';
			foreach($authors as $author)
			{
				$bookAuthors .= $author->getName().',';
			}
			
			$bookInfo = array( 'info' => 'foundInDB' );
			$bookInfo['success'] = 'true' ;
			$bookInfo['title'] =  $book->getTitle();
			$bookInfo['isbn10'] = $book->getIsbn10();
			$bookInfo['isbn13'] = $book->getIsbn13();
			$bookInfo['description'] = $book->getDescription();
			$bookInfo['imgUrl'] = $book->getIsbn10().".jpg";
			$bookInfo['authors'] = $bookAuthors;
      
      if($edit == 'false')
      {
        $this->editable = false;
      } else
      {
        $this->editable = true;
      }
      
			$this->bookinfo = $bookInfo;	
		}
		else {
			//get book info from adlibris
			$this->isbn = $request->getParameter('isbn');
		}
		
  }
  
  //CREATE NEW USER
  public function executeInsertUser(sfWebRequest $request)
  {
		$Fname = $request->getParameter('Fname');
		$Lname = $request->getParameter('Lname');
		$email = $request->getParameter('email');
		$phone = $request->getParameter('phone');
		$city = $request->getParameter('city');
		$street = $request->getParameter('street');
		$postalcode = $request->getParameter('postalcode');
		$pass = $request->getParameter('pass');
		$repass = $request->getParameter('repass');

  		if($pass != "" && $pass == $repass)
  		{	  		
  		
	  		$newUser = new User();
	  		$newUser->setFname($Fname);
	  		$newUser->setLname($Lname);
	  		$newUser->setEmail($email);
	  		$newUser->setPhone($phone);
	  		$newUser->setCity($city);
	  		$newUser->setStreet($street);
	  		$newUser->setCredentials("student");
	  		$newUser->setPostalCode($postalcode);
	  		$newUser->setPassword(md5($pass));
        $newUser->setCreatedOn(date('U'));
        $newUser->setIsActive(0); // sätter användaren som ännu inte aktiv...
        
  			$newUser->save();
  		
  		  $params = array('msg' => "user created",);
        
        //skicka mail till användaren: 
        //länken tas omhand av funktionen 'shared/activateUser/hash=...'
        $hash = md5($email.'_tddd27');
        $recipient = $email.'_'.$Fname.' '.$Lname;
        $msg = "Användaren har skapats.<br/>Ett mail har skickats till din e-post adress.<br/>Innan du kan logga in måste du konfirmera e-postadressen genom att klicka på länken i mailet.";
        $params = array('msg'=>$msg, 'recipient'=>$recipient, 'hash'=>$hash);
  		}
  		else
  		{
      
        //om skapandet misslyckas
    		$msg = "Användaren kunde inte skapas, var vänlig kontrollera att mail och lösenord är korrekt ifyllda.";
        $params = array('msg'=>$msg);
  		}
      
  		$this->redirect('public/index?'.http_build_query($params));

  }
  
  public function executeActivateUser($request)
  {
      $hash = $request->getParameter('hash');
      
      //get all users that have not been activated
      $c = new Criteria();
      $c->add(UserPeer::IS_ACTIVE, 0);
      $notActiveUsers = UserPeer::doSelect($c);
      
      foreach($notActiveUsers as $user)
      {
        $email = $user->getEmail();
        $pass  = $user->getPassword();
        
        $control = md5($email.'_tddd27');
        if( $hash == $control )
        {
            $user->setIsActive(1);
            $user->save();
            $msg = 'Din användare är nu aktiverad, välkommen att logga in!';
            $this->redirect('public/index?msg='.$msg);
        }
      }
  }
  
  public function executeUpdateUser($request)
  {	
  //	echo "HEJ";
  		$userType = $this->getUser()->getAttribute("credential");
  		$userID = $request->getParameter('userID');
		$email = $request->getParameter('email');
		
	//	$phone = $request->getParameter('phone');
		$city = $request->getParameter('city');
		$street = $request->getParameter('street');
		$postalcode = $request->getParameter('postalcode');
		
		// password update variables
		$currPass = $request->getParameter('currPass');
		$rePass = $request->getParameter('newPass');
  		$reNewpPass = $request->getParameter('reNewPass');
	
  	
  		$user= UserPeer::retrieveByPk($userID);

	  		$user->setEmail($email);
	  		//$newUser->setPhone($phone);
	  		$user->setCity($city);
	  		$user->setStreet($street);
	  		$user->setPostalCode($postalcode);
	  		//$newUser->setPassword($pass);
	  		
	  		if($user->getPassword() == md5($currPass))
	  		{
	  			if($rePass == $reNewpPass)
	  			{

	  				$user->setPassword(md5($rePass));
	  				//$msg
	  			}
	  		}
	  		
			//change credentials
			
			
	  		if($userType == "admin")
	  		{
	  			$newCredentials = $request->getParameter('credential');
	  			$user->setCredentials($newCredentials);
	  			echo $user->getCredentials();
	  		}
			$user->save();

			
		return sfView::NONE;
		
  }
  

  public function executeRemoveComment($request)
  {	
		$commentId = $request->getParameter('commentID');
		
		if(isset($commentId)){
		$comment = CommentPeer::retrieveByPk($commentId);
		
		$comment->delete(); 
		}
		return sfView::NONE;
		
  }

  public function executeBookComments($request)
  {	
		$this->isbn10 = $request->getParameter('isbn10');
		$this->user= $this->getUser()->getAttribute('loggedInId');
		$this->userType = $this->getUser()->getAttribute('credential');
		$this->editCommentList = array();
		$this->commentList = "";
		if(isset($this->isbn10)){

			$c = new Criteria();
			$c->add(CommentPeer::ISBN10, $this->isbn10);
			$this->commentList = CommentPeer::doSelect($c);

		}

		
		
  }
  
    public function executeAddBookComment($request)
  {	
		$this->isbn10 = $request->getParameter('isbn10');
		$user= $this->getUser()->getAttribute('loggedInId');
		$commentContent = $request->getParameter('commentContent');
		if(isset($this->isbn10)){

			$comment = new Comment();
			$comment->setIsbn10($this->isbn10);
			$comment->setUserid($user);
			$comment->setContent($commentContent);
			$comment->setCreatedon(date("U"));
		
			$comment->save();

		}
		return sfView::NONE;
		
  }
  
  /**************************************/
  /*hämta senaste priset ifrån adLibris */
  /**************************************/
  public function executeGetPrice($request)
  {
    include_once('simple_html_dom.php');
    $isbn = $request->getParameter('isbn');
    
    $isbn = trim($isbn);
    
    //define label we are looking for and an error label
    $price_label = '.price';
    $error_label = '#ctl00_main_frame_ctrlproduct_lblError';
    
    // Create DOM from URL
		$html = file_get_html("http://www.adlibris.com/se/product.aspx?isbn=".$isbn);
    
    // Check if the search was successful
		$exists = $html->find($error_label);
		if(!$exists)
		{
      //get book price
			$price = $html->find($price_label,0);
			$price = utf8_encode($price->plaintext);
      
      $price = explode(" ", $price);
      $price = $price[0];
      
    } else {
      $price = -1;
    }
    //eka ett svar
    $this->result = array('price' => $price);
  }
  
}
