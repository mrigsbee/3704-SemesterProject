<?php

class Rating extends DbObject {
    const DB_TABLE = "rating";

    //database fields
    protected $id;
    protected $overall;

    //constructor
    public function __construct($args = array()){
        $defaultArgs = array(
            'id' => null,
            'overall' => null
        );

        $args += $defaultArgs;

        $this->id = $args['id'];
        $this->overall = $args['overall'];
    }

    //save changes to database
    public function save(){
        $db = Db::instance();

        $db_properties = array(
            'overall' => $this->overall
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
