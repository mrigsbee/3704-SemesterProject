<?php

include_once '../global.php';

// get the identifier for the page we want to load
$action = $_GET['action'];

// instantiate a SiteController and route it
$sc = new SiteController();
$sc->route($action);

class SiteController {

	// route us to the appropriate class method for this action
	public function route($action) {
		switch($action) {
			case 'home':
				$this->home();
				break;
			case 'editpost':
				$this->editpost();
				break;
			case 'editpost_submit':
				$this->editpost_submit();
				break;
			case 'newpost':
				$this->newpost();
				break;
			case 'newpost_submit':
				$this->newpost_submit();
				break;
			case 'deletepost':
				$this->deletepost();
				break;
			// case 'signup':
			// 	$this->signup();
			// 	break;
			// case 'login':
			// 	$this->login();
			// 	break;
			// case 'postlogin':
			// 	$this->postlogin();
			// 	break;
			case 'calendar':
				$this->calendar();
				break;
			case 'chat':
				$this->chat();
				break;
			case 'upvote':
				$this->upvote();
				break;
			case 'downvote':
				$this->downvote();
				break;
		}
	}

    public function home() {
		//self::loggedInCheck();
		$_SESSION['username'] = "jdoe"; //change this ******************************************************************************************

		//Get forumid associated with the current crn
		$crnid = 1; //Not implemented
		$crn_row = Crn::loadById($crnid);
		$forumid = $crn_row->get('forumId');

		//retrieve all posts from the forum
		$posts = ForumPost::getAllPosts($forumid);
		include_once SYSTEM_PATH.'/view/home.tpl';
	}

	public function editpost(){
		$postid = $_POST['edit'];

		$post_row = ForumPost::loadById($postid);
		$title = $post_row->get('title');
		$body = $post_row->get('description');
		$tag = $post_row->get('tag');
		include_once SYSTEM_PATH.'/view/edit.tpl';
	}
	public function editpost_submit(){
		if (isset($_POST['Cancel'])) {
			header('Location: '.BASE_URL);
			exit();
		}

		$postid = $_POST['postid'];
		$post = ForumPost::loadById($postid);

		$title = $_POST['title'];
		$body = $_POST['description'];
		$tag = $_POST['tag'];
		$timestamp = date("Y-m-d", time());

		$post = ForumPost::loadById($postid);
		$post->set('title', $title);
		$post->set('description', $body);
		$post->set('tag', $tag);
		$post->set('timestamp', $timestamp);
		$post->save();

		header('Location: '.BASE_URL);
	}

	public function calendar(){
		include_once SYSTEM_PATH.'/view/calendar.tpl';
	}

	public function chat(){
		include_once SYSTEM_PATH.'/view/chat.tpl';
	}

	public function upvote(){
		//retrieve variables
		$postid = $_POST['upvote'];
		$user = User::loadByUsername($_SESSION['username']);
		$userid = $user->get('id');

		//check if user previously downvoted
		$old_rating = Rating::loadByUserAndPostId($userid, $postid);
		if($old_rating != null){
			$old_rating->delete();
			header('Location: '.BASE_URL);
			exit();
		} else {
			//save user's voting preference
			$rating = new Rating();
			$rating->set('userId', $userid);
			$rating->set('postId', $postid);
			$rating->set('rating', 1);
			$rating->save();

			header('Location: '.BASE_URL);
			exit();
		}
	}

	public function downvote(){
		$postid = $_POST['downvote'];
		$user = User::loadByUsername($_SESSION['username']);
		$userid = $user->get('id');

		//check if user previously downvoted
		$old_rating = Rating::loadByUserAndPostId($userid, $postid);
		if($old_rating != null){
			$old_rating->delete();
			header('Location: '.BASE_URL);
			exit();
		} else {
			//save user's voting preference
			$rating = new Rating();
			$rating->set('userId', $userid);
			$rating->set('postId', $postid);
			$rating->set('rating', -1);
			$rating->save();

			header('Location: '.BASE_URL);
			exit();
		}

		header('Location: '.BASE_URL);
	}

	public function newpost(){
		include_once SYSTEM_PATH.'/view/newpost.tpl';
	}
	public function newpost_submit(){
		if (isset($_POST['Cancel'])) {
			header('Location: '.BASE_URL);
			exit();
		}

		$title = $_POST['title'];
		$description = $_POST['description'];
		$tag = $_POST['tag'];
		$timestamp = date("Y-m-d", time());
		$author = $_SESSION['username'];

		//get author's id
		$user_row = User::loadByUsername($author);
		$userid = $user_row->get('id');

		//add a rating
		$rating = new Rating();
		$rating->set('userId', $userid);
		$rating->set('rating', 0);
		$rating->save();

		$post = new ForumPost();
		$post->set('userId', $userid);
		$post->set('timestamp', $timestamp);
		$post->set('title', $title);
		$post->set('description', $description);
		$post->set('tag', $tag);
		$post->set('ratingId', $rating->get('id'));
		$post->set('forumId', 1); //hardcoded, only 1 CRN page exists
		$post->save();

		$rating->set('postId', $post->get('id'));
		$rating->save();
		header('Location: '.BASE_URL);
	}

	public function deletepost(){
		$postid = $_POST['delete'];
		$post_row = ForumPost::loadById($postid);
		$post_author_id = $post_row->get('userId');
		$post_author = User::loadById($post_author_id);

		//user is the author of the post, allow delete
		if($post_author->get('username') == $_SESSION['username']){
			$post_row->delete();
		}

		//refresh page
		header('Location: '.BASE_URL);
	}

	// public function signup(){
	// 	$teams = Team::getAllTeams();
	// 	include_once SYSTEM_PATH.'/view/signup.tpl';
	// }
	//
	// public function login(){
	// 	include_once SYSTEM_PATH.'/view/login.tpl';
	// }
	//
	// public function postlogin(){
	//  	$un = $_POST['username'];
	// 	$pw = $_POST['password'];
	// 	$user = User::loadByUsername($un);
	// 	if($user == null) {
	// 		// username not found
	// 		$_SESSION['error'] = "<b>Uh oh!</b> Username <u>".$un."</u> not found!";
	// 		header('Location: '.BASE_URL.'/login');
	// 	} // incorrect password
	// 	elseif($user->get('password') != $pw)
	// 	{
	// 		$_SESSION['error'] = "<b>Uh oh!</b> Incorrect password for username <u>".$un."</u>";
	// 		header('Location: '.BASE_URL.'/login');
	// 	}
	// 	else
	// 	{
	// 		$_SESSION['username'] = $un;
	// 		$_SESSION['success'] = "Welcome back, <u>".$un."</u>!";
	// 		header('Location: '.BASE_URL);
	// 	}
	// }
	//
	// private function loggedInCheck(){
	// 	//checks if user  is logged in
	// 	// if not redirects to sign up page
	// 	if( !isset($_SESSION['username']) || $_SESSION['username'] == '')
	// 	{
	// 		header('Location: '.BASE_URL.'/login');
	// 	}
	// 	else
	// 	{
	// 		$user = User::loadByUsername($_SESSION['username']);
	// 		$userName = $user->get('username');
	// 	}
	// }
// 	public function signupRegister() {
// 		// get post data
// 		$username  = $_POST['username'];
// 		$teamname = $_POST['nteams'];
// 		$passwd = $_POST['passwd'];
// 		$email  = $_POST['email'];
//
// 		// do some simple form validation
//
// 		// are all the required fields filled?
// 		if ($username == '' || $teamname == '' || $passwd == '' || $email == '') {
// 			// missing form data; send us back
// 			$_SESSION['error'] = 'Please complete all registration fields.';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
// 		if(strlen($username) > 25){
// 			$_SESSION['error'] = 'Sorry, that username is too long.';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
// 		if(strlen($passwd) > 30){
// 			$_SESSION['error'] = 'Sorry, that password is too long.';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
// 		if(preg_match('/[^A-Za-z0-9]/', $username)){
// 			$_SESSION['error'] = 'Sorry, that username contains invalid characters';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
//
// 		// is username in use?
// 		$user = User::loadByUsername($username);
// 		if(!is_null($user)) {
// 			// username already in use; send us back
// 			$_SESSION['error'] = 'Sorry, that username is already in use. Please pick a unique one.';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
// 		$user = User::loadByEmail($email);
// 		if(!is_null($user)) {
// 			// email is in use
// 			$_SESSION['error'] = 'Sorry, that email is already in use. Please pick a different one.';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
// 		$allowed_domains = array("vt.edu");
// 		$email_domain = array_pop(explode("@", $email));
// 		if(!in_array($email_domain, $allowed_domains)) {
//     	// Not an authorised email
// 			$_SESSION['error'] = 'Sorry, that email is not a vt.edu email';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
//
// 		$user = User::loadByEmail($email);
// 		if(!is_null($user)) {
// 			// username already in use; send us back
// 			$_SESSION['registerError'] = 'Sorry, that email is already in use. Please pick a different one.';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
// 		$allowed_domains = array("vt.edu");
// 		$email_domain = array_pop(explode("@", $email));
// 		if(!in_array($email_domain, $allowed_domains)) {
//     	// Not an authorised email
// 			$_SESSION['registerError'] = 'Sorry, that email is not a vt.edu email';
// 			header('Location: '.BASE_URL.'/signup');
// 			exit();
// 		}
//
// 		// okay, let's register
// 		$user = new User();
// 		$user->set('username', $username);
// 		$user->set('teamname', $teamname);
// 		$user->set('password', $passwd);
// 		$user->set('email', $email);
// 		$user->save(); // save to db
// /*
// Was going to try and update a counter
// 		//$user_row = User::loadByUsername($username);
// 		$team = Team::loadByTeamname($teamname);
// 		$count = $team->get('membercount');
// 		$team->set('score', $team->get('score'));
// 		$team->set('membercount', $count++);
// 		$team->save();
// 		*/
//
// 		// log in this freshly created user and redirect to home page
// 		$_SESSION['username'] = $username;
// 		$_SESSION['success'] = "You successfully registered as ".$username.".";
// 		header('Location: '.BASE_URL);
// 		exit();
// 	}
}
