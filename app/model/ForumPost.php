<?php

class ForumPost extends DbObject {
    const DB_TABLE = "forumpost";

    //database fields
    protected $id;
    protected $userId;
    protected $title;
    protected $description;
    protected $tag;
    protected $ratingId;
    protected $forumId;


    //constructor
    public function __construct($args = array()){
        $defaultArgs = array(
            'id' => null,
            'userId' => null,
            'title' => '',
            'description' => '',
            'tag' => '',
            'ratingId' => null,
            'forumId' => null
        );

        $args += $defaultArgs;

        $this->id = $args['id'];
        $this->userId = $args['userId'];
        $this->title = $args['title'];
        $this->description = $args['description'];
        $this->tag = $args['tag'];
        $this->ratingId = $args['ratingId'];
        $this->forumId = $args['forumId'];

    }

    //save changes to database
    public function save(){
        $db = Db::instance();

        $db_properties = array(
            'userId' => $this->userId,
            'title' => $this->title,
            'description' => $this->description,
            'tag' => $this->tag,
            'ratingId' => $this->ratingId,
            'forumId' => $this->forumId
        );

        $db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
    }

    public static function loadById($id){
        $db = Db::instance();
        $obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
        return $obj;
    }
}
?>
