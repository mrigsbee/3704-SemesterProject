<?php
class User extends DbObject {
    // name of database table
    const DB_TABLE = 'user';
    // database fields
    protected $id;
    protected $name;
    protected $username;
    protected $email;
    protected $password;

    // constructor
    public function __construct($args = array()) {
        $defaultArgs = array(
            'id' => null,
            'name' => '',
            'username' => '',
            'email' => '',
            'password' => ''
            );
        $args += $defaultArgs;
        $this->id = $args['id'];
        $this->name = $args['name'];
        $this->username = $args['username'];
        $this->email = $args['email'];
        $this->password = $args['password'];
    }
    // save changes to object
    public function save() {
        $db = Db::instance();
        // omit id and any timestamps
        $db_properties = array(
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password
        );
        $db->store($this, __CLASS__, self::DB_TABLE, $db_properties);
    }
    // delete object
    public function delete()
    {
         $db = Db::instance();
            $query = sprintf(" DELETE FROM %s  WHERE username = '%s' AND pw = '%s' ",
            self::DB_TABLE,
            $this->username,
            $this->pw
            );
            $ex = mysql_query($query);
            if(!$ex)
            die ('Query failed:' . mysql_error());
    }
    // load object by ID
    public static function loadById($id) {
        $db = Db::instance();
        $obj = $db->fetchById($id, __CLASS__, self::DB_TABLE);
        return $obj;
    }
    // load user by username
    public static function loadByUsername($username=null) {
        if($username === null)
            return null;
        $query = sprintf(" SELECT id FROM %s WHERE username = '%s' ",
            self::DB_TABLE,
            $username
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


     // load user by username
    public static function loadByEmail($email=null) {

        if($email === null)
            return null;
        $query = sprintf(" SELECT id FROM %s WHERE email = '%s' ",
            self::DB_TABLE,
            $email
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
