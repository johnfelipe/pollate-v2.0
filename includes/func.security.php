<?php

function strip_tags_content($text, $tags = '', $invert = FALSE){
    preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
    $tags = array_unique($tags[1]);

    if(is_array($tags) AND count($tags) > 0) {
        if($invert == FALSE) {
            return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
        } else {
            return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
        }
    } elseif($invert == FALSE) {
        return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    return $text;
}

function sc_sec($data, $html = false) {
	global $db;
	$post = $db->real_escape_string($data);
	$post = trim($post);
	$post = ($html) ? htmlspecialchars($post) : htmlspecialchars(strip_tags_content($post));
	return $post;
}

function sc_pass($data) {
	return md5(sha1(md5(sha1($data))));
}

function sc_array($data, $dataType = 'char'){
		$array = array();
		$data  = array_filter($data);
    if(count($data)){
        foreach( $data AS $d )
            $array[] = $dataType == 'int' ? (int)($d) : sc_sec($d);
    }
		return $array;
}

function check_email($email){
	$address = strtolower(trim($email));
	return (preg_match("/^[a-zA-Z0-9_.-]{1,40}+@([a-zA-Z0-9_-]){2,30}+\.([a-zA-Z0-9]){2,20}$/i",$address));
}

function check_image($image){
	return (preg_match("/(https?:\/\/.*\.(?:png|jpg))/i",$image));
}

function sc_folderName ($str = '')
{
    $str = strip_tags($str);
    $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
    $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
    $str = strtolower($str);
    $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
    $str = htmlentities($str, ENT_QUOTES, "utf-8");
    $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
    $str = str_replace(' ', '-', $str);
    $str = rawurlencode($str);
    $str = str_replace('%', '-', $str);
    return $str;
}
