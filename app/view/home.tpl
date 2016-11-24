<html>

<head>
  <title>CRNShare</title>
  <link href="<?= BASE_URL ?>/public/css/bootstrap.min.css" rel="stylesheet">
  <link href="<?= BASE_URL ?>/public/css/style.css" type="text/css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-2.2.0.js"></script>
</head>

<body>

  <div id="med_rectangle">
    <div id="signout">Sign Out</div>
    <div id="signedin">Signed in as <em><?php echo $_SESSION['username']?></em></div>
  </div>

  <div id="main">

    <h1>CRNShare</h1>

    <div id="flat_rectangle">
      <ul class="tabrow">
        <li class="selected">Home</li>
        <li><a href="<?= BASE_URL ?>/calendar/">Calendar</a></li>
        <li><a href="<?= BASE_URL ?>/chat/">Chat</a></li>
      </ul>
    </div>

    <div id="flat_rectangle">
      <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Change Current CRN</button>
        <div id="myDropdown" class="dropdown-content">
          <a href="#">CRN 00000</a>
          <a href="#">CRN 11111</a>
          <a href="#">CRN 22222</a>
        </div>
      </div>
    </div>

    <div id="tall_rectangle"></div>

    <!-- New forum post button -->
    <form id="newforumpost" method="POST" action="<?= BASE_URL ?>/newpost" class="form-horizontal" role="form">
        <button>
          New Forum Post
        </button>
    </form>

    <!-- Forum Posts  -->
    <table id="t1">
        <?php
        if($posts != null){
            foreach($posts as $post){
                $rating_row = Rating::loadById($post->get('ratingId'));
                $rating = $rating_row->get('rating');
                echo '
              	    <tr>
                	<td id="t1">
                        <!-- Upvote button -->
                		<div id="up_vote">
                            <form id="edit" method="POST" action="'.BASE_URL.'/upvote" class="form-horizontal" role="form">
                                <input type="hidden" name="upvote" value="'.$post->get('id').'"/>
                                <button >
                                  <img style="width:20px;height:20px;float:center;" src="'.BASE_URL.'/public/images/up_arrow.png"/>
                                </button>
                            </form>
                        </div>
                		<h3>'.$rating.'</h3>
                        <!-- Downvote button -->
                		<div id="down_vote">
                            <form id="edit" method="POST" action="'.BASE_URL.'/downvote" class="form-horizontal" role="form">
                                <input type="hidden" name="downvote" value="'.$post->get('id').'"/>
                                <button >
                                  <img style="width:20px;height:20px;float:center;" src="'.BASE_URL.'/public/images/down_arrow.png"/>
                                </button>
                            </form>
                        </div>
                	</td>
                	<td id="t1"><table id="t2">
                		<tr>
                			<td>
                            <h2>'.$post->get('title').'</h2>

                              <div id="edit_box">
                                  <form id="edit" method="POST" action="'.BASE_URL.'/editpost" class="form-horizontal" role="form">
                                      <input type="hidden" name="edit" value="'.$post->get('id').'"/>
                                      <button class="edit_button" name="button">
                                        <img style="width:20px;height:20px;" src="'.BASE_URL.'/public/images/edit.png"/>
                                      </button>
                                  </form>
                              </div>

                              <div id="delete_box">
                              <form id="delete" method="POST" action="'.BASE_URL.'/deletepost" class="form-horizontal" role="form">
                                  <input type="hidden" name="delete" value="'.$post->get('id').'"/>
                                  <button>
                                    <img style="width:20px;height:20px;" src="'.BASE_URL.'/public/images/trash.png"/>
                                  </button>
                                  </form>
                              </div>

                            </td>
                		</tr>
                		<tr>';
                            //get username from id
                            $userid = $post->get('userId');
                            $user_row = User::loadById($userid);
                            $author = $user_row->get('username');
                			echo '<td><h5>submitted on '.$post->get('timestamp').' by <em>'.$author.'</em> to <em>'.$post->get('tag').'</em></h5></td>
                		</tr>
                		<tr>
                			<td>'.$post->get('description').'</td>
                		</tr>
                		<tr>
                			<td><div id="comments">9 comments</h5></div>
                		</tr>
                	</table></td>
              	  </tr>';
              }// end loop
          } //end if
    ?>
	</table>

  </div>
  <script type="text/javascript" src="<?= BASE_URL ?>/public/js/main.js"></script>
  <script src="<?= BASE_URL ?>/public/js/bootstrap.min.js"></script>
</body>

</html>
