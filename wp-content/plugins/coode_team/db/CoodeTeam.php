<?php

class CoodeTeam{

  const TABLE = 'coode_team_plugin';

  static function add($value){
    global $wpdb;
    $tablename = $wpdb->prefix . self::TABLE;

    $toSave = [
      'img_path'	=> $value['img_path'],
      'name'     	=> $value['name'],
      'linkedin'    => $value['linkedin'],
      'mail'  		=> $value['mail'],
      'freelancer'	=> $value['freelancer']
    ];

    $result = $wpdb->insert($tablename, $toSave);
    return $result>0 ? $wpdb->insert_id : 0;
  }


  static function getAll(){
    global $wpdb;
    $tablename = $wpdb->prefix . self::TABLE;

    $queryStr = 'SELECT * FROM '. $tablename .' ORDER BY member_id ASC';
    return $wpdb->get_results($queryStr, ARRAY_A);
  }
}
