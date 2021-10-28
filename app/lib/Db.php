<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

namespace app\lib;

use PDO;

class Db
{
    protected $db;

    private $host, $dbname, $username, $password;

    public function __construct(){

       $config = require 'app/config/db.php';

       $this->host = $config['host'];
       $this->dbname = $config['db_name'];
       $this->username = $config['user'];
       $this->password = $config['password'];

       $this->db = new PDO("mysql:host=$this->host; dbname=$this->dbname; charset=utf8", $this->username, $this->password);
    }

    public function query($sql, $params = [])
    {
      $stmt = $this->db->prepare($sql);
      if (!empty($params)) {
        foreach ($params as $key => $val) {
          $stmt->bindValue(':'.$key, $val);
        }
      }
      $stmt->execute();
      return $stmt;
    }

    public function findall($sql, $params = [])
    {
      $result = $this->query($sql, $params);
      return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function find($sql, $params = [])
    {
      $result = $this->query($sql, $params);
      return $result->fetchColumn();
    }

    public function lastInsertId() 
    {
      return $this->db->lastInsertId();
    }

    public function getMaxIdPlus($table)
    {
      $result = Db::find("SELECT MAX(`id`) FROM $table");

      return $result += 1;
    }

    public function getMaxId($table)
    {
      return Db::find("SELECT MAX(`id`) FROM $table");
    }

    public function getId($table, $id)
    {
      return Db::find("SELECT * FROM $table WHERE id = '$id'");
    }

    public function getNameId($table, $name)
    {
      return Db::find("SELECT * FROM $table WHERE name = '$name'");
    }

    public function deleteColum($table, $var)
    {
      Db::query("DELETE FROM `$table` WHERE `$table`.`id` = $var");
    }

    public function message($status, $message)
    {
      exit(json_encode(['status' => $status, 'message' => $message]));
    }

    public function update($table, $colum, $values, $id)
    {
      Db::query("UPDATE $table SET $colum = '$values' WHERE id = '$id' ");
    }

    public function plusLike($colum, $values, $id)
    {
      Db::query("UPDATE `posts` SET $colum = '$values' WHERE id = '$id'");
    }

    public function minusLike($colum, $values, $id)
    {
      Db::query("UPDATE `posts` SET $colum = '$values' WHERE id = '$id'");
    }

    public function isPostExists($id) {
    $params = [
      'id' => $id,
    ];
    return $this->db->column('SELECT id FROM posts WHERE id = :id', $params);
    }

    public function nameValidate($nameLen) // Валидация имени
    {
      if ($nameLen < 3 or $nameLen > 100) {
        Db::message('error', 'The name must be at least 3 and no more than 100 and characters');
      }else{
        return true;
      }
    }

  public function descriptionValidate($descriptionLen)
  {
    if ($descriptionLen < 3 or $descriptionLen > 1000) {
      Db::message('error', 'The description must be at least 3 and no more than 1000 and characters');
    }else{
      return true;
    }
  }

  public function textValidate($textLen)
  {
    if ($textLen < 10 or $textLen > 5000) {
      Db::message('error', 'The text must be at least 100 and no more than 5000 and characters');
    }else{
      return true;
    }
  }

  public function editName($name, $id)
  {
    if (!empty($name)) {
      Db::nameValidate(iconv_strlen($name));
      Db::update('posts', 'name', $name, $id);
    }else{
      Db::message('error', 'The name field is empty');
    }
  }

  public function editDescription($description, $id)
  {
    if (!empty($description)) {
      Db::descriptionValidate(iconv_strlen($description));
      Db::update('posts', 'description', $description, $id);
    }else{
      Db::message('error', 'The description field is empty');
    }
  }

  public function editText($text, $id)
  {
    if (!empty($text)) {
      Db::textValidate(iconv_strlen($text));
      Db::update('posts', 'text', $text, $id);// обновляет значение 1.имя таблици 2.колонка 3.новое значение 4.id 
    }else{
      Db::message('error', 'The text field is empty');
    }
  }


}