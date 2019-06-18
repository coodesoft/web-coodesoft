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

  static function update($value, $id){
  	global $wpdb;
  	$tablename = $wpdb->prefix . self::TABLE;

  	$result = $wpdb->update( $tablename, $value, ['member_id' => $id]);
  	return $result>0 ? $id : 0;
  }

  static function getAll(){
    global $wpdb;
    $tablename = $wpdb->prefix . self::TABLE;

    $queryStr = 'SELECT * FROM '. $tablename .' ORDER BY member_id ASC';
    return $wpdb->get_results($queryStr, ARRAY_A);
  }

  static function del($id){
  	$uid = intval($id);
  	if (!$uid)
  		return;


  	global $wpdb;
  	$tablename = $wpdb->prefix . self::TABLE;

  	$member = self::getById($id);
  	if ( unlink( $member['img_path']) )
  		return $wpdb->delete( $tablename, ['member_id' => $id], ['%d'] );

  	return false;
  }

  static function getById($id){
	$uid = intval($id);
	if (!$uid)
		return;

	global $wpdb;
	$tablename = $wpdb->prefix . self::TABLE;

	$query = 'SELECT * FROM '. $tablename.' WHERE member_id='.$id;
	return $wpdb->get_row( $query, ARRAY_A );
  }
}
