<?php
class UserRating extends DbObject {
    const DB_TABLE = "userrating";
    //database fields
    protected $id;
    protected $userid;
    protected $ratingid;
    //constructor
    public function __construct($args = array()){
        $defaultArgs = array(
            'id' => null,
            'userid' => null,
            'ratingid' => null
        );
        $args += $defaultArgs;
        $this->id = $args['id'];
        $this->userid = $args['userid'];
        $this->ratingid = $args['ratingid'];
    }
    //save changes to database
    public function save(){
        $db = Db::instance();
        $db_properties = array(
            'userid' => $this->userid,
            'ratingid' => $this->ratingid
        );
        $db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
    }
    public static function loadById($id){
        $db = Db::instance();
        $obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
        return $obj;
    }
    public static function getAllByUser($user){
        $query = sprintf(" SELECT * FROM %s WHERE username = '%s' ORDER BY picid ASC",
            self::DB_TABLE,
            $user
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
    public static function getRow($user, $picid) {
        $query = sprintf(" SELECT * FROM %s WHERE userid='%s' AND ratingid='%s' ",
            self::DB_TABLE,
            $userid,
            $ratingid
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
    public function delete()
    {
         $db = Db::instance();
            $query = sprintf(" DELETE FROM %s  WHERE userid = '%s' AND ratingid = '%s' ",
            self::DB_TABLE,
            $this->userid,
            $this->ratingid
            );
            $ex = mysql_query($query);
            if(!$ex)
            die ('Query failed:' . mysql_error());
    }
}
?>
