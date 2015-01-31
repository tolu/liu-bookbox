<?php

/**
 * student actions.
 *
 * @package    switcharoo
 * @subpackage student
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class teacherComponents extends sfComponents
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeEditAccountMenu()
  {
  	$this->menuElements = array();
  	$this->loggedInId = $this->getUser()->getAttribute('loggedInId');

  }
  
  public function executeRightContentWidgets()
  {
  	
  }
  
  public function executeCourseList($request)
  {
	
	$userId = $request->getParameter('userID');
	
			$c = new Criteria();
		 	$c->add(CoursesPeer::USER_ID, $userId);

			$this->courseList = CoursesPeer::doSelect($c);
			$this->myUserType = $this->getUser()->getAttribute('credential');


			$this->editable = false;
			if($userId ==  $this->getUser()->getAttribute('loggedInId') || $this->myUserType =="admin"){
				$this->editable = true;
			}	

  }
  
    public function executeCourseLitteratureList($request)
  {
	
	$userId = $request->getParameter('userID');
	
			$c = new Criteria();
		 	$c->add(CoursesPeer::USER_ID, $userId);

			$this->courseList = CoursesPeer::doSelect($c);
			$this->myUserType = $this->getUser()->getAttribute('credential');

			$this->courseLitteratureList = array();
			foreach($this->courseList as $course)
			{
					
				$c = new Criteria();
		 		$c->add(CourselitteraturePeer::COURSE_CODE, $course->getId());
				$c->addJoin(BookPeer::ISBN10, CourselitteraturePeer::ISBN10);
				
				$this->courseLitteratureList[$course->getId()]= CourselitteraturePeer::doSelectJoinBook($c);
				//$this->courseLitteratureList[$course->getId()]['bookList']=	BookPeer::doSelect($c);
			}

			$this->editable = false;
			if($userId ==  $this->getUser()->getAttribute('loggedInId') || $this->myUserType =="admin"){
				$this->editable = true;
			}	

  }
  
    public function executeCourseListWidget($request)
  {

	$userId = $this->getUser()->getAttribute('loggedInId');
	
			$c = new Criteria();
		 	$c->add(CoursesPeer::USER_ID, $userId);

			$this->courseList = CoursesPeer::doSelect($c);
			$this->myUserType = $this->getUser()->getAttribute('credential');

  }
}
