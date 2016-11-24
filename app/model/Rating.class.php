<?php

class Rating extends DbObject {
    const DB_TABLE = "rating";

    //database fields
    protected $id;
    protected $rating;
    protected $postId;
    protected $userId; //rating given by this user

    //constructor
    public function __construct($args = array()){
        $defaultArgs = array(
            'id' => null,
            'rating' => null,
            'postId' => null,
            'userId' => null
        );

        $args += $defaultArgs;

        $this->id = $args['id'];
        $this->rating = $args['rating'];
        $this->postId = $args['postId'];
        $this->userId = $args['userId'];
    }

    //save changes to database
    public function save(){
        $db = Db::instance();

        $db_properties = array(
            'rating' => $this->rating,
            'postId' => $this->postId,
            'userId' => $this->userId
        );

        $db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
    }

    public static function loadById($id){
        $db = Db::instance();
        $obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
        return $obj;
    }

    //gets all the ratings for a post; used for calcAvg()
    private static function getAllRatingsByPost($postId){
        $query = sprintf(" SELECT * FROM %s WHERE postid=%s",
            self::DB_TABLE,
            $postId
        );

        $db = Db::instance();
        $result = $db->lookup($query);
        if(!mysql_num_rows($result))
            return null;
        else {
            $objects = array();
            while($row = mysql_fetch_assoc($result)) {
                $objects[] = self::loadById($row['id']);
            }
            return ($objects);
        }
    }

    public function inc(){
       $db = Db::instance();
       $query = sprintf(" UPDATE %s SET rating=rating+1 WHERE id = '%s'",
           self::DB_TABLE,
           $this->id
       );
       mysql_query($query);
    }

    public function dec(){
       $db = Db::instance();
       $query = sprintf(" UPDATE %s SET rating=rating-1 WHERE id = '%s'",
           self::DB_TABLE,
           $this->id
       );
       mysql_query($query);
    }

   // Get the rating given by a user for a specific post
   // Used to show the user they have rated a post
   public static function loadByUserAndPostId($postId, $userId) {
       $query = sprintf(" SELECT * FROM %s WHERE postId = '%s' AND userId='%s' ",
           self::DB_TABLE,
           $postId,
           $userId
           );
       $db = Db::instance();
       $result = $db->lookup($query);
       if(!mysql_num_rows($result))
           return null;
       else {
           $row = mysql_fetch_assoc($result);
           $obj = self::loadById($row['id']);
           return ($obj);
       }
   }
}
?>
