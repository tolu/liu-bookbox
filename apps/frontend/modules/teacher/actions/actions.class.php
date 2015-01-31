<?php

/**
 * teacher actions.
 *
 * @package    switcharoo
 * @subpackage teacher
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class teacherActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  public function executeIndex(sfWebRequest $request)
  {
  	$this->userType =$this->getUser()->getAttribute("credential");
  	  	$this->userName =  $this->getUser()->getAttribute('name');
  }
  
    public function executeSearch()
  {
  	$this->forward('shared', 'search');
  }
  
  
   
  public function executeProfile($request)
  {	
  		$this->userType =$this->getUser()->getAttribute("credential");
  		$userId = $request->getParameter('userID');
  		$this->userName =  $this->getUser()->getAttribute('name');
		$this->loggedInId = $this->getUser()->getAttribute('loggedInId');
  		
  		$this->editable = false;
  		
  		if($this->getUser()->getAttribute('loggedInId') == $userId  || $this->userType =="admin")
  		{
  			$this->editable = true;
  		}
  		
  		$this->user = UserPeer::retrieveByPk($userId);
	
		if($this->user->getCredentials() == "student")
		{
			$this->redirect('student/profile?userID='.$userId);
		}
	
	//$this->getUser()->hasCredential('student');		

	
  }
  
    public function executeEditProfile($request)
  {	

  		$this->userType =$this->getUser()->getAttribute("credential");
  		$userId = $request->getParameter('userID');
  		$this->userName =  $this->getUser()->getAttribute('name');
		$this->loggedInId = $this->getUser()->getAttribute('loggedInId');
  		
  		$this->editable = false;
  		
  		if($this->getUser()->getAttribute('loggedInId') == $userId  || $this->userType =="admin")
  		{
  			$this->editable = true;
  		}
  		
  		$this->user = UserPeer::retrieveByPk($userId);
	  	
	
  }

   
  public function executeProfileContent($request)
  {	
  		$this->userType =$this->getUser()->getAttribute("credential");
  		$userId = $request->getParameter('userID');
  		$this->userName =  $this->getUser()->getAttribute('name');
		$this->loggedInId = $this->getUser()->getAttribute('loggedInId');
  		
  		$this->editable = false;
  		
  		if($this->getUser()->getAttribute('loggedInId') == $userId || $this->userType =="admin")
  		{
  			$this->editable = true;
  		}
  		

  		$this->user = UserPeer::retrieveByPk($userId);
  		
  		if($this->user->getCredentials() == "student")
		{
			$this->redirect('student/profile?userID='.$userId);
		}
  }

    public function executeAddCourse($request)
  {	
  	$this->userType =$this->getUser()->getAttribute("credential");
	  	$this->userName =  $this->getUser()->getAttribute('name');
	  	
	  	$this->form = new CoursesForm();
  }
  
  public function executeRemoveCourse($request)
  {	
	  	$courseCode =  $request->getParameter('courseCode');
	  		  	
	  	$c = new Criteria();
 	
 		$c->add(CourselitteraturePeer::COURSE_CODE, $courseCode);
 		
		$courseLitteratureList = CourselitteraturePeer::doSelect($c);
	  	
	  	foreach( $courseLitteratureList as $courseLitterature)
	  	{
	  		$courseLitterature->delete();
	  	}
	  	
	  	$thisCourse = CoursesPeer::retrieveByPk($courseCode);
	  	
	  	$thisCourse = CoursesPeer::retrieveByPk($courseCode);
	  	
	  	//echo $thisCourse->getUserId();  
	  	
	  	$thisCourse->delete();
	  	
	  	return SFVIEW::NONE;
  }
  
  public function executeAddCourseLitterature($request)
  {	

  	 $courseId = $request->getParameter('courseId');

  	 $isbn10 = $request->getParameter('isbn10');
  	 $year = $request->getParameter('year');
  	 
  	 	  	$newCourseLitterature = new Courselitterature();
	  		$newCourseLitterature->setCourseCode(trim($courseId));	
	  		$newCourseLitterature->setIsbn10(trim($isbn10));
	  	//	$newCourseLitterature->setYear($year);

//$newCourseLitterature->getCourseCode();
  			$newCourseLitterature->save();
  	 
  	 echo $newCourseLitterature->getCourseCode().$newCourseLitterature->getIsbn10();
		return sfView::NONE;
  }
  
  public function executeRemoveCourseLitterature($request)
  {	
  	$courseLitteratureId =  $request->getParameter('courseLitteratureId');
  	
		$thisCourseLitterature = CourselitteraturePeer::retrieveByPk($courseLitteratureId);
	  	 
	  	
	 	$thisCourseLitterature->delete();


		return sfView::NONE;
  }
  
  public function executeInsertCourse(sfWebRequest $request)
  {

		$courseId = $request->getParameter('courseId');
		$courseName = $request->getParameter('courseName');
		$courseYear = $request->getParameter('courseYear');
		
  		if($courseName != "" && $courseYear != "")
  		{	  		
  		
	  		$newCourse = new Courses();
	  		$newCourse->setId($courseId);
	  		$newCourse->setCourseName($courseName);
			$newCourse->setCourseYear($courseYear);
  			$newCourse->setUserId($this->getUser()->getAttribute('loggedInId'));
  			$newCourse->save();
  			
  		  	$params = array(
    			'msg'    => "course created",

  			);
 

  		}
  		else
  		{
  		  		  	$params = array(
    			'msg'    => "the course could not be created please verify that the coursename and year are correct",

  			);
  		}
  		$this->redirect('teacher/profile?userID='.$this->getUser()->getAttribute('loggedInId'));

  		//$this->redirect('public/addUser?email='.$newUser->getEmail());

  }

  
}
