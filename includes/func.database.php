<?php

function db_select($data) {
	global $db;
	$data['column'] = isset($data['column']) ? $data['column'] : '*';
	$data['join']   = isset($data['join'])   ? "LEFT JOIN ".prefix.$data['join'] : '';
	$data['where']  = isset($data['where'])  ? "WHERE ".$data['where'] : '';
	$data['order']  = isset($data['order'])  ? $data['order'] : '';
	$sql = $db->query( "SELECT {$data['column']} FROM ".prefix."{$data['table']} {$data['join']} {$data['where']} {$data['order']}" ) or die($db->error);
	return $sql;
}

function db_insert($table, $array) {
	global $db;
	$columns = implode(',', array_keys($array));
	$values  = implode(',', array_values($array));
	$query   = "INSERT INTO ".prefix."{$table} ({$columns}) VALUES ({$values})";
	return $db->query($query) or die($db->error);
}

function db_delete($table, $id, $id_col = 'id', $more = '') {
	global $db;
	$query   = "DELETE FROM ".prefix."{$table} WHERE {$id_col} = '{$id}' {$more}";
	return $db->query($query) or die($db->error);
}

function db_trash($table, $id, $id_col = 'id', $more = '') {
	global $db;
	$query   = "UPDATE ".prefix."{$table} SET trash = 1 WHERE {$id_col} = '{$id}' {$more}";
	return $db->query($query) or die($db->error);
}

function db_update($table, $array, $id, $id_col = 'id') {
	global $db;
	$columns = array_keys($array);
	$values  = array_values($array);
	$count   = count($columns);

	$update  = '';
	for($i=0;$i<$count;$i++)
		$update .= "{$columns[$i]} = {$values[$i]}" . ($count == $i+1 ? '' : ', ');

	$query   = "UPDATE ".prefix."{$table} SET {$update} WHERE {$id_col} = '{$id}'";
	return $db->query($query) or die($db->error);
}

function db_count($table, $count = 'id'){
	global $db;
	$sql = $db->query("SELECT COUNT({$count}) FROM ".prefix."{$table}") or die($db->error);
	$rs  = $sql->fetch_row();
	$sql->close();
	return $rs[0];
}

function db_get($table, $field, $id, $where='id', $other=false){
	global $db;
	$sql = $db->query("SELECT {$field} FROM ".prefix."{$table} WHERE {$where} = '{$id}' {$other}") or die($db->error);
	if($sql->num_rows > 0){
		$rs = $sql->fetch_row();
		$sql->close();
		return $rs[0];
	}
}

function db_rows($table, $field = 'id'){
	global $db;
	$sql = $db->query("SELECT {$field} FROM ".prefix."{$table}");
	$rs  = $sql->num_rows;
	$sql->close();
	return $rs;
}

function db_rs($data) {
	$rs = $data->num_rows ? $data->fetch_assoc() : '';
	$data->close();
	return $rs;
}


function db_break($data){
	return preg_replace( '#(\\\r\\\n)#', '<br/>', nl2br($data) );
}

function db_global(){
	global $db;
	$sql = $db->query("SELECT * FROM ".prefix."configs");
	if($sql){
		while( $rs = $sql->fetch_assoc() )
			define( $rs['variable'], $rs['value'] );

		$sql->close();
	}
}

function db_update_global($var, $val){
	return db_update("configs", ['value' => "'{$val}'"], $var, 'variable');
}

function db_login_details(){
	global $db;
	$log_session = ( isset($_SESSION['login']) ? (int)$_SESSION['login'] : ( isset($_COOKIE['login']) ? (int)$_COOKIE['login'] : 0 ) );

  if( isset($log_session) && $log_session != 0 ){
   $sql = $db->query( "SELECT * FROM ".prefix."users WHERE id = '{$log_session}'" );
   $rs  = $sql->fetch_assoc();
   foreach ( $rs as $key => $val )
         define( 'us_'. $key, $val);

   $sql->close();
  } else {
      $sql = $db->query( "DESCRIBE ".prefix."users" );
      while( $rs = $sql->fetch_assoc() ){
				define( 'us_' . $rs['Field'], (in_array(str_replace(' unsigned', '', $rs['Type']), ['tinyint(1)','int(11)','int(10)']) ? 0 : ''));
			}


      $sql->close();
  }
}


function db_unserialize($data){
	if($data){
		$uns = unserialize($data[0]);
		return $uns ? $uns[$data[1]] : 0;
	} else {
		return 0;
	}
}

function db_serialize_update($data){
	if($data){
		$uns = unserialize($data[0]);
		$uns[$data[1]] = $data[2];
		return serialize($uns);
	} else {
		return 0;
	}
}

function db_output($data, $break = false, $bbcode = false){
	$data = stripslashes($data);
	$data = ($break) ? nl2br($data) : $data;
	$data = ($bbcode) ? fh_bbcode($data) : $data;
	return $data;
}
