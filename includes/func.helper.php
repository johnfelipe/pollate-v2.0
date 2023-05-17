<?php

function fh_answers_labels($question, $questiontype){
	global $_COOKIE;
  $sql = db_select([
    'table' => 'answers',
    'where' => 'question = '. $question
  ]);
  if($sql->num_rows){
    $label = ($questiontype != 1) ? '<div class="pl-row">' : null;
		$inp_type = (db_get("questions", "multiple", $question) ? 'checkbox' : 'radio');
    while($rs = $sql->fetch_assoc()){
      $label .= ($questiontype != 1 ? ($questiontype == 3 ? '<div class="pl-col-4">' : '<div class="pl-col-6">' ) : null );
      $label .= '
			<div class="pl-radio'.($questiontype != 1 ? ($questiontype == 3 ? ' pl-pics' : ' pl-bool' ) : null ).''.(fh_voted($rs['id'], 'answer') ? ' pl-checked' : '').'">
			  <input id="'.$rs['id'].'" type="'.$inp_type.'" name="pl-vote-inp[]" value="'.$rs['id'].'"'.(fh_voted($question) ? ' disabled' : '').'>
	      <label for="'.$rs['id'].'">
					'.(fh_voted($question) ? '
					<small class="timer timer-'.$rs['id'].'" data-count="'.fh_percentage($rs['id'], $question).'%">'.fh_percentage($rs['id'], $question).'%</small>
					' : '').'
					'.($questiontype == 3 ? '<div class="pl-label-thumb"><img src="'.path.'/'.$rs['thumbnail'].'" alt="'.$rs['answer'].'" onerror="this.src=\''.fh_thumbERROR('radio').'\'" /></div>' : null).$rs['answer'].'
				</label>
		  </div>';
      $label .= ($questiontype != 1) ? '</div>' : null;
    }
    $label .= ($questiontype != 1) ? '</div>' : null;
    return $label;
  }
}

function fh_user($id, $link = true, $cut = false, $count = 25){
	if(!$id){
		return false;
	}
  $rs = db_rs(db_select([
    'table'  => 'users',
    'column' => 'id, username',
    'where'  => 'id = '.$id
  ]));
	$username = ($cut ? fh_textCut($rs['username'], $count): $rs['username']);
	return ($link) ? '<a href="'.path.'/profile.php?id='.fh_seoURL($rs['id'], 'profile', $username).'">'.$username.'</a>' : $username;
}

function fh_ago($tm = '', $at = true, $rcs = 0) {
	global $lang;
	$cur_tm = time();
	$pr_year = $cur_tm - 3600*24*365;
	$pr_month = $cur_tm - 3600*24*31;
	if( $tm > $pr_month ){
		$dif    = $cur_tm-$tm;
		$pds = array();
		foreach ($lang['timedate'] as $kk){
			$pds[] = $kk;
			if( $kk == 'decade' ) break;
		}

		$lngh   = array(1,60,3600,86400,604800,2630880,31570560,315705600);
		for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

		$no = floor($no); if($no <> 1 && !$lang['rtl']) $pds[$v] .=($lang['lang'] == 'en' ? 's': ''); $x=sprintf("%d %s ",$no,$pds[$v]);
		if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
		return "{$x} {$lang['timedate']['time_ago']}";
	} else {
        if($lang['lang'] == 'en'){
            return ($at?date('d M, Y \a\t H:i', $tm):date('d M, Y', $tm));
        } else {
            return ($at?date('d M, Y \a\t H:i', $tm):date('d M, Y', $tm));
        }


	}
}

function fh_alerts($alert, $type = 'danger', $html = true) {
	global $lang;

	$title = $lang['alerts'][$type];

  return ($html) ? '<div class="alert alert-'.$type.'">
            <strong>'.$title.'</strong> '.$alert.'
          </div>' : '<strong>'.$title.'</strong> '.$alert;
}


function fh_planAccess($type, $type_id = 0){
	$access = false;
	if (site_plan && us_level != 6) {
		switch ($type) {
			case 'ask':
				$count = db_rows("questions WHERE FROM_UNIXTIME(date,'%m-%Y') = '".date('m-Y', time())."' && author = '".us_id."'");
				if($count <= plan_polls_month){
					$access = true;
				}
			break;
			case 'vote':
				$count = db_rows("votes WHERE FROM_UNIXTIME(date,'%m-%Y') = '".date('m-Y', time())."' && user = '{$type_id}'");
				if($count <= plan_votes_month){
					$access = true;
				}
			break;
			case 'iframe':
				if(db_get("plans", "iframe", db_get("users", "plan", $type_id)+1)){
					$access = true;
				}
			break;
			case 'gender':
				if(plan_gender){
					$access = true;
				}
			break;
			case 'age':
				if(plan_age){
					$access = true;
				}
			break;
			case 'location':
				if(plan_location){
					$access = true;
				}
			break;
			case 'export':
				if(plan_export){
					$access = true;
				}
			break;
			case 'ads':
				if(!plan_ads){
					$access = true;
				}
			break;
		}
	} else {
		$access = true;
	}

	return $access;
}


function fh_percentage($answer_id, $question_id){
	if(db_rows("votes WHERE answer = '{$answer_id}'")){
		$answer_votes	= db_count("votes WHERE answer = '{$answer_id}'") * 100;
		$total_votes	= db_count("votes WHERE question = '{$question_id}'");
		$option			  = $answer_votes / $total_votes;
		$option			  = ceil($option);
	} else {
		$option = 0;
	}
	return $option;
}

function fh_bbcode($text){
	$match = [
		'/\[B\]/isU',
		'/\[\/B\]/isU',
		'/\[I\]/isU',
		'/\[\/I\]/isU',
		'/\[S\]/isU',
		'/\[\/S\]/isU',
		'/\[U\]/isU',
		'/\[\/U\]/isU',

		'/\[IMG width=(.*) height=(.*)\](.*)\[\/IMG\]/isU',
		'/\[IMG\](.*)\[\/IMG\]/isU',
		'/\[URL=(.+)\]/isU',
		'/\[\/URL\]/isU',

		'/\[COLOR=(.*)\]/isU',
		'/\[\/COLOR\]/isU',
		'/\[SIZE=1\]/isU',
		'/\[SIZE=2\]/isU',
		'/\[SIZE=3\]/isU',
		'/\[SIZE=4\]/isU',
		'/\[SIZE=5\]/isU',
		'/\[SIZE=6\]/isU',
		'/\[SIZE=7\]/isU',
		'/\[\/SIZE\]/isU',

		'/\[LEFT\](.*)\[\/LEFT\]/isU',
		'/\[RIGHT\](.*)\[\/RIGHT\]/isU',
		'/\[CENTER\]/isU',
		'/\[\/CENTER\]/isU',
		'/\[quote\](.*)\[\/quote\]/isU',
		'/\[CODE\](.*)\[\/CODE\]/isU',

		'/\[video\](.*)\[\/video\]/isU',
		'/\[youtube\](.*)\[\/youtube\]/isU',

		'/\[list=1\](.*)\[\/list\]/isU',
		'/\[ul\](.*)\[\/ul\]/isU',
		'/\[ol\](.*)\[\/ol\]/isU',
		'/\[\*\](.*)\[\/\*\]/isU',
		'/\[\li\](.*)\[\/\li\]/isU',

		'/\[\TR\]/isU',
		'/\[\/\TR\]/isU',
		'/\[\TD\]/isU',
		'/\[\/\TD\]/isU',
		'/\[\TABLE\]/isU',
		'/\[\/\TABLE\]/isU',

		'/\[HR\]/isU',
	];

	$replace = [
		'<b>',
		'</b>',
		'<i>',
		'</i>',
		'<strike>',
		'</strike>',
		'<u>',
		'</u>',

		'<img src="$3" style="width:$1px;height:$2px;" />',
		'<img src="$1" />',
		'<a href="$1">',
		'</a>',

		'<span style="color:$1">',
		'</span>',
		'<span style="font-size:8px">',
		'<span style="font-size:12px">',
		'<span style="font-size:14px">',
		'<span style="font-size:16px">',
		'<span style="font-size:18px">',
		'<span style="font-size:20px">',
		'<span style="font-size:22px">',
		'</span>',

		'<p class="text-left">$1</p>',
		'<p class="text-right">$1</p>',
		'<p class="text-center">',
		'</p>',
		'<blockquote>$1</blockquote>',
		'<pre>$1</pre>',

		'<iframe src="https://www.youtube.com/embed/$1" width="560" height="420" frameborder="0"></iframe>',
		'<iframe src="https://www.youtube.com/embed/$1" width="560" height="420" frameborder="0"></iframe>',

		'<ul class="decimal">$1</ul>',
		'<ul class="circle">$1</ul>',
		'<ol class="decimal">$1</ol>',
		'<li>$1</li>',
		'<li>$1</li>',
		'<tr>',
		'</tr>',
		'<td>',
		'</td>',
		'<table>',
		'</table>',

		'<hr/>',
	];


	$regex = '/\[font=.*?\]|\[\/font\]/i';
	$text = preg_replace($regex, '', $text);

	return nl2br(preg_replace($match, $replace, $text));
}

function fh_resset_p($text, $link = '#', $rep = ''){
	$wrapper = '
		width: 480px;
		margin: 12px auto;
		color: #666;
		font-size: 16px;
		border: 1px solid #EEE;
		padding: 24px;
		border-radius: 3px;
	';
	$button = '
		display: block;
		background: #f43438;
		color: #fff;
		height: 48px;
		line-height: 48px;
		padding: 0 24px;
		font-size: 18px;
		border-radius: 3px;
		text-align: center;
		text-decoration: none;
	';
	$text = '<div style="'.$wrapper.'">'.$text.'</div>';
	$match = [
		'/\{button\}/',
		'/\{button bg=\#([A-Za-z0-9]+)\}/',
		'/\{\/button\}/',
	];
	$replace = [
		'<a href="'.$link.'" style="'.$button.'">',
		'<a href="'.$link.'" style="'.$button.'background:#$1">',
		'</a>',
	];

	$pr_r = preg_replace($match, $replace, $text);

	if(!$rep)
		return $pr_r;
	else
		return preg_replace(['/\{name\}/', '/\{email\}/'], $rep, $pr_r);
}



function fh_sex($value){
	global $lang;
  switch($value){
		case 1: return $lang['register']['gender']['male']; break;
		case 2: return $lang['register']['gender']['female']; break;
		default: return '--';
	}
}

function fh_birth($value){
	$day   = db_unserialize([$value, 0]);
	$month = db_unserialize([$value, 1]);
	$year  = db_unserialize([$value, 2]);
	$time  = strtotime("{$month}/{$day}/{$year}");
	return fh_ago($time, false);
}

function fh_regAdress($id){
	global $countries, $lang;
	$value = '
		<div class="pl-select">
			<select name="reg_address">
				<option value="">'.$lang['register']['address']['country'].'</option>';
				foreach( $countries AS $k => $c )
					$value .= '<option value="'.$k.'"'.($k==$id?' selected':'').'>'.$c.'</option>';
	$value .= '
			</select>
		</div>';
	return $value;
}

function fh_regCities($id){
	global $tr_cities;
	$value = '
			<div class="pl-select">
					<select name="reg_city">';
							foreach( $tr_cities AS $k => $c )
							$value .= '<option value="'.$k.'"'.($k==$id?' selected':'').'>'.$c.'</option>';
	$value .= '
					</select>
			</div>';
	return $value;
}

function newImgFolder($folder){
	if(!is_dir($folder)){
		return mkdir($folder);
	} else {
		return 0;
	}
}

function url_slug($str){
  $str = mb_strtolower( trim( $str ), 'UTF-8' );
  $str = preg_replace('/[[:^alnum:]]/iu', ' ', $str);
  $str = trim($str);
  $str = preg_replace('/\s+/', '-', $str);
  return $str;
}

function fh_seoURL($url, $type = '', $title = ''){

	$title = fh_seoURLCheck($title);
	$url = $url.($title?'&title='.$title:'');

	return $url;
}

function fh_seoURLCheck($title){

	$turkish = array("ı", "ğ", "ü", "ş", "ö", "ç");
	$english   = array("i", "g", "u", "s", "o", "c");

	$title = str_replace($turkish, $english, $title);

	$title = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($title, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));

	return $title;
}

function fh_notificationSET($id, $type = ''){
	$data = [];
	switch($type){
		case 'tag' :
		case 'vote' :
		case 'comment' :
			$data['user'] = "'".db_get('questions', 'author', $id)."'";
			break;
		case 'follow' :
			$data['user'] = "'{$id}'";
			break;
	}
	if(!empty($data)){
		$data['ntype']  = "'{$type}'";
		$data['nid']    = "'{$id}'";
		$data['author'] = "'".us_id."'";
		$data['date']   = "'".time."'";
        if($data['user']!=$data['author'])
		  return db_insert('notifications', $data);
        else
            return 0;
	} else {
		return 0;
	}
}

function fh_notificationGET($id, $type){
	global $lang;
	$noty = '';
	switch($type){
		case 'tag' :
			$noty = $lang['header']['noty']['tag'].' &ldquo;'.fh_textCut(db_get('questions', 'question', $id), 15).'&rdquo;';
			break;
		case 'vote' :
			$noty = $lang['header']['noty']['vote'].' &ldquo;'.fh_textCut(db_get('questions', 'question', $id), 15).'&rdquo;';
			break;
		case 'comment' :
			$noty = $lang['header']['noty']['comment'].' &ldquo;'.fh_textCut(db_get('questions', 'question', $id), 15).'&rdquo;';
			break;
		case 'follow' :
			$noty = $lang['header']['noty']['follow'];
			break;
	}
	return $noty;
}

function fh_notificationUrlGET($id, $type){
	$noty = '';
	switch($type){
		case 'tag' :
		case 'vote' :
		case 'comment' :
			$noty = path.'/questions.php?id='.fh_seoURL($id, 'questions', db_get('questions', 'question', $id));
			break;
		case 'follow' :
			$noty = path.'/profile.php?id='.fh_seoURL($id, 'users', db_get('users', 'username', $id));
			break;
	}
	return $noty;
}

function fh_notificationDEL($id, $type){
	return db_delete('notifications', $id, "nid", "AND author = '".us_id."' AND ntype = '{$type}'");
}

function fh_thumbERROR($image, $type = false){
	if($image == 'user'){
		return ($type == 2 ? userGirl : userMan);
	} else {
		return transparent;
	}
}

function fh_creditSET($type = ''){
	$credit = 0;
	switch($type){
		case 'sign-up' : $credit = credits_register; break;
		case 'ask'     : $credit = credits_question; break;
		case 'vote'    : $credit = credits_vote; break;
		case 'comment' : $credit = credits_comment; break;
	}
	return $credit;
}

function fh_creditGET($id){

	return $id;
}

function fh_textCut($str, $n = 500, $end_char = '&#8230;'){
  if (strlen($str) < $n){
      return $str;
  }

  $str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));
  if (strlen($str) <= $n){
      return $str;
  }

  $out = "";
  foreach (explode(' ', trim($str)) as $val){
      $out .= $val.' ';
      if (strlen($out) >= $n){
          $out = trim($out);
          return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
      }
  }
}

function fh_ip(){
  foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
    if (array_key_exists($key, $_SERVER) === true){
    	foreach (explode(',', $_SERVER[$key]) as $ip){
        $ip = trim($ip); // just to be safe

        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
          return $ip;
        }
      }
    }
  }
}

function fh_voted($question, $type = 'question'){
  global $_COOKIE;
	if(isset($_COOKIE["{$type}_{$question}"])){
		return true;
	} elseif(db_rows("votes WHERE {$type} = '{$question}' AND author != 0 AND author = '".us_id."'")) {
		return true;
	} /*elseif(fh_ip() && db_rows("votes WHERE {$type} = '{$question}' AND ip = '".fh_ip()."'")) {
		return true;
	} */else {
		return false;
	}
}

function fh_sidebarQuestions($id) {
	global $lang;
	$rs = db_rs(db_select([
			'table'  => 'questions',
			'column' => 'id, question, statistics, author, date, thumbnail',
			'where'  => 'trash = 0 && moderat = 0 && id = '.$id
	]));
	return '
	<li>
			<div class="pl-thumb"><img src="'.path.'/'.$rs['thumbnail'].'" alt="'.$rs['question'].'" onerror="this.src=\''.transparent.'\'"></div>
			<div class="pl-body">
					<h4><a href="'.path.'/questions.php?id='.fh_seoURL($rs['id'], 'questions', $rs['question']).'">'.$rs['question'].'</a></h4>
					<div class="pl-details">
							<i class="icon-user icons"></i><span> '.str_replace('{user}', fh_user($rs['author']), $lang['questions']['by']).'</span>
							<i class="icon-bubbles icons"></i><span> '.db_unserialize([$rs['statistics'], 'comments']).' '.$lang['questions']['replies'].'</span>
					</div>
			</div>
	</li>
	';
}

function randomColor(){
  $result = array('rgb' => '', 'hex' => '');
  foreach(array('r', 'b', 'g') as $col){
    $rand = mt_rand(0, 255);
    $result['rgb'][$col] = $rand;
    $dechex = dechex($rand);
    if(strlen($dechex) < 2){
      $dechex = '0' . $dechex;
    }
    $result['hex'] .= $dechex;
  }
  return $result;
}

function fh_questionDetails($rs){
	global $lang;
	$share_url  = path."/questions.php?id=".fh_seoURL($rs['id'], 'questions', $rs['question']);
	?>
	<div class="pl-question<?=($rs['polltype'] ? ($rs['polltype'] == 3 ? ' pl-question-pics' : ' pl-question-bool' ) : null )?><?=(!$rs['thumbnail'] ? ' pl-nothumb' : null )?>">
		<div class="pl-question-cnt">
			<div class="pl-content">

				<!-- Poll Options -->
				<div class="pl-options">
					<div>
						<a href="<?=path?>/index.php?type=categories&amp;id=<?=fh_seoURL($rs['category'], 'categories', $rs['title'])?>">
							<i class="<?=$rs['icon']?>" title="<?=$rs['title']?>" style="background-color: #<?=$rs['bg']?>"></i>
						</a>
						<?php if($rs['pinned']): ?>
						<a href="#" class="pt-pinned"><i class="fas fa-thumbtack"></i> <?=$lang['ask']['pinned']?></a>
						<?php endif; ?>
					</div>
					<div>
						<ul>
							<?php if($rs['author'] == us_id || us_level == 6): ?>
							<li><a href="<?=path?>/statistics.php?id=<?=fh_seoURL($rs['id'], 'questions', $rs['question'])?>" class="pl-plus-buttons pl-notext" title="<?=$lang['questions']['report']?>"><i class="fas fa-chart-bar"></i></a></li>
							<?php endif; ?>
							<li class="pl-share">
								<span class="pl-plus-buttons pl-share-button"><i class="fas fa-share"></i><b><?=$lang['questions']['share']['title']?></b></span>
								<ul class="dropdown">
									<li><a class="pl-show-embed" href="#"><i class="fas fa-share bg-instagram embed"></i> <?=$lang['questions']['share']['iframe']?></a></li>
									<li>
										<a class="puerto-popup" href="https://www.facebook.com/sharer/sharer.php?u=<?=$share_url?>"><i class="fab fa-facebook bg-facebook"></i> <?=$lang['questions']['share']['fb']?></a>
									</li>
									<li>
										<a class="puerto-popup" href="https://twitter.com/intent/tweet/?text=<?=urlencode($rs['question'])?>&mp;url=<?=$share_url?>&amp;via=pollatecom"><i class="fab fa-twitter bg-twitter"></i> <?=$lang['questions']['share']['tw']?></a>
									</li>
									<li>
										<a class="puerto-popup" href="https://plus.google.com/share?url=<?=$share_url?>"><i class="fab fa-google-plus bg-google"></i> <?=$lang['questions']['share']['gp']?></a>
									</li>
								</ul>
							</li>
							<?php if(db_count("tags WHERE author = '".us_id."' AND question = '{$rs['id']}'")): ?>
							<li><a href="#" class="pl-question-unfollow pl-plus-buttons pl-notext" rel="<?=$rs['id']?>" title="<?=$lang['questions']['unfollow']?>"><i class="far fa-star"></i></a></li>
							<?php else: ?>
							<li><a href="#" class="pl-question-follow pl-plus-buttons pl-notext" rel="<?=$rs['id']?>" title="<?=$lang['questions']['follow']?>"><i class="fas fa-star"></i></a></li>
							<?php endif; ?>
							<li><a href="#" data-toggle="modal" data-target="#report-modal" class="pl-question-flag pl-plus-buttons pl-notext" rel="<?=$rs['id']?>" title="<?=$lang['questions']['report']?>"><i class="fas fa-flag"></i></a></li>
						</ul>
					</div>
				</div>

				<!-- Poll Title -->
				<h3 class="pl-title">
					<a href="<?=path?>/questions.php?id=<?=fh_seoURL($rs['id'], 'questions', $rs['question'])?>"><?=$rs['question']?></a>
				</h3>

				<!-- Poll Thumbnail -->
				<?php if($rs['polltype'] != 3 && $rs['thumbnail']): ?>
				<div class="pl-cover">
					<img src="<?=path?>/<?=$rs['thumbnail']?>" alt="<?=$rs['question']?>" onerror="this.src='<?=transparent?>'" />
				</div><!-- End Cover -->
				<?php endif; ?>

				<!-- Poll Author -->
				<div class="pl-author<?=(db_get('users', 'level', $rs['author'])==6?' pl-admin':'')?>">
					<div class="pl-thumb">
						<img src="<?=db_get('users', 'photo', $rs['author'])?>" alt="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=fh_thumbERROR('user', db_get('users', 'sex', $rs['author']))?>'">
					</div>
					<?php if(db_get('users', 'level', $rs['author'])==6): ?>
					<i class="icon-support icons pl-admin-badge" title="<?=$lang['admin']?>"></i>
					<?php else: ?>
						<?php if(db_get('users', 'verified', $rs['author'])==1): ?>
						<i class="icon-check icons pl-verified" title="<?=$lang['verified']?>"></i>
						<?php endif; ?>
					<?php endif; ?>
					<?=str_replace('{user}', fh_user($rs['author']), $lang['questions']['by'])?> | <?=fh_ago($rs['date'])?>
				</div>

				<!-- Poll Answers -->
				<div class="pl-answers<?=(fh_voted($rs['id']) ? ' pl-answers-checked' : '')?>">
					<?=fh_answers_labels($rs['id'], $rs['polltype'])?>
				</div>
				<!-- Poll End date -->
				<?php if($rs['end_date'] && time > $rs['end_date']): ?>
				<div>
					<p class="pl-warning">
						<i class="icon-exclamation icons"></i>
						<span><?=$lang['questions']['alert']['expired']?> <em><?=fh_ago($rs['end_date'])?></em>!</span>
					</p>
				</div>
				<?php endif; ?>

				<!-- Poll IFrame -->
				<div class="pt-embed-form">
					<a href="#" class="pl-hide-embed"><i class="fas fa-times"></i></a>
					<pre class="radius">&lt;iframe style=&quot;width: 460px;height:315px&quot; src=&quot;<?=str_replace('questions.php', 'iframe.php', $share_url)?>&quot; frameborder=&quot;0&quot;&gt;&lt;/iframe&gt;</pre>
				</div>

				<!-- Poll Details -->
				<div class="pl-details">
					<a href="<?=path?>/voters.php?id=<?=fh_seoURL($rs['id'], 'questions', $rs['question'])?>" class="pl-plus-buttons pl-show-votes"><i class="far fa-thumbs-up"></i><b><?=db_unserialize([$rs['statistics'], 'votes'])?></b> <?=$lang['questions']['votes']?></a>
					<a href="<?=path?>/questions.php?id=<?=fh_seoURL($rs['id'], 'questions', $rs['question'])?>" class="pl-plus-buttons pl-show-replies"><i class="far fa-comments"></i><b><?=db_unserialize([$rs['statistics'], 'comments'])?></b> <?=$lang['questions']['replies']?></a>
					<a href="<?=path?>/tags.php?id=<?=fh_seoURL($rs['id'], 'questions', $rs['question'])?>" class="pl-plus-buttons pl-show-tags"><i class="fas fa-users"></i><b><?=db_unserialize([$rs['statistics'], 'tags'])?></b> <?=$lang['questions']['tags']?></a>
				</div>
			</div><!-- End Content -->
		</div><!-- End pl-question-cnt -->
	<?php
}

function fh_sendQuestion(){
	global $lang, $qs_thumbnail, $qs_question, $qs_category, $qs_end_date, $qs_polltype, $qs_id, $qs_answers, $qs_answers_id, $qs_answers_i, $qs_multiple, $qs_pinned;

	# Move thumbnail
	$thumbnail_rename = ($qs_id)?db_get('questions', 'thumbnail', $qs_id):'';
	if($qs_thumbnail){
		if(file_exists($qs_thumbnail)){
			$thumbnail_rename = 'uploads/users/'.sc_folderName(us_username).str_replace('uploads-temp', '', $qs_thumbnail);
			newImgFolder('uploads/users/'.sc_folderName(us_username));
			rename($qs_thumbnail, $thumbnail_rename);
			// Need to delete the old image when edit
		}
	}

	# Insert Question
	$qs_end_date = (!$qs_end_date ? $qs_end_date : 0 );
	$data = [
		"question"    => "'{$qs_question}'",
		"category"    => "'{$qs_category}'",
		"thumbnail"   => "'{$thumbnail_rename}'",
		"end_date"    => "'{$qs_end_date}'",
		"multiple"    => "'{$qs_multiple}'",
		"pinned"      => "'{$qs_pinned}'"
	];

	if(site_letters)
		$data['moderat'] = "'1'";

	if(!$qs_id){
		$data['polltype']   = "'{$qs_polltype}'";
		$data['date']       = "'".time."'";
		$data['author']     = "'".us_id."'";
		$data['statistics'] = "'".serialize(['votes'=>0,'tags'=>0,'comments'=>0])."'";
		db_insert("questions", $data);

		# Update category questions
		db_update('categories', ['questions'=>"questions+1"], $qs_category);

		# User Statistics & Credits
		$us_statistics    = us_statistics;
		$us_tags          = db_unserialize([$us_statistics, 'questions']);
		$us_statistics_up = db_serialize_update([$us_statistics, 'questions', $us_tags+1]);
		db_update("users", ["statistics" => "'".$us_statistics_up."'", "credits" => "credits+".fh_creditSET('ask').""], us_id);

		# Insert Answers
		$answer_qs  = db_get("questions", "id", us_id, "author", "ORDER BY id DESC LIMIT 1");
		foreach($qs_answers as $key => $answer){
			$answer_data = [
				'question' => "'{$answer_qs}'",
				'answer'   => "'{$answer}'"
			];
			# For answers with images
			if($qs_polltype == 3){
				if(file_exists($qs_answers_i[$key])){
					newImgFolder('uploads/users/'.sc_folderName(us_username));

					$handle = new Upload($qs_answers_i[$key]);
				  if ($handle->uploaded) {
						$handle->allowed            = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
						$handle->file_new_name_body = md5(uniqid());
						if ($handle->image_src_x > 300){
							$handle->image_resize          = true;
							$handle->image_ratio_fill      = true;
							$handle->image_y               = 300;
							$handle->image_x               = 300;
						}
				    $handle->Process('uploads/users/'.sc_folderName(us_username));

				    if ($handle->processed) {
							$answer_i_rename = 'uploads/users/'.sc_folderName(us_username). DIRECTORY_SEPARATOR . $handle->file_dst_name;
				    }
				  }
				  unset($handle);

					// Need to delete the old image when edit
				}
				$answer_data['thumbnail'] = "'{$answer_i_rename}'";
			}
			db_insert("answers", $answer_data);
		}

		# Display Successs
		return [
				'type'  =>'success',
				'alert' => fh_alerts($lang['ask']['alert']['success'], 'success')
		];

	} else {
		if(db_get('questions', 'author', $qs_id) == us_id || us_level == 6){
			$data['updated_at'] = "'".time."'";
			db_update("questions", $data, $qs_id);

			# Update Answers
			if(in_array(db_get('questions', 'polltype', $qs_id), [1, 3])){
				foreach($qs_answers as $key => $answer){
					$answer_data = [
						'answer'   => "'{$answer}'"
					];


					if($qs_polltype == 3){
						if(file_exists($qs_answers_i[$key])){
							newImgFolder('uploads/users/'.sc_folderName(us_username));

							$handle = new Upload($qs_answers_i[$key]);
						  if ($handle->uploaded) {
								$handle->allowed            = array('image/jpeg','image/jpg','image/gif','image/png','image/bmp');
								$handle->file_new_name_body = md5(uniqid());
								if ($handle->image_src_x > 300 || $handle->image_src_y > 300){
									$handle->image_resize          = true;
									$handle->image_ratio_fill      = true;
									$handle->image_y               = 300;
									$handle->image_x               = 300;
								}
						    $handle->Process('uploads/users/'.sc_folderName(us_username));

						    if ($handle->processed) {
									$answer_i_rename = 'uploads/users/'.sc_folderName(us_username). DIRECTORY_SEPARATOR . $handle->file_dst_name;
						    }
						  }
						  unset($handle);

							// Need to delete the old image when edit
						}
						$answer_data['thumbnail'] = "'{$answer_i_rename}'";
					}


					$answers_id = (isset($qs_answers_id[$key])) ? $qs_answers_id[$key] : 0;
					if(db_rows("answers WHERE id = '{$answers_id}' AND question = '{$qs_id}'")){
						db_update("answers", $answer_data, $answers_id);
					} else {
						$answer_data['question'] = "'{$qs_id}'";
						db_insert("answers", $answer_data);
					}
				}
			}

			return [
					'type'  =>'success',
					'alert' => fh_alerts($lang['ask']['alert']['edit'].$qs_multiple, 'success')
			];
		} else {
			return [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['ask']['alert']['permission'])
			];
		}
	}
}




/* @function boolean send_mail(PHPMailer $mailer, string $mail, string $mail_from, string $subject, string $body, array $data)
 * Send a mail, replace strings in body
 * @param mailer PHPMailer object
 * @param mail Destination
 * @param mail_from Sender
 * @param subject Subject
 * @param body Body
 * @param data Data for string replacement
 * @return result
 */
function fh_send_mail($mailer, $mail, $mail_from, $mail_from_name, $subject, $body, $data) {
    $result = false;
    if(!is_a($mailer, 'PHPMailer')) {
        error_log("send_mail: PHPMailer object required!");
        return $result;
    }
    if (!$mail) {
        error_log("send_mail: no mail given, exiting...");
        return $result;
    }
    /* Replace data in mail, subject and body */
    foreach($data as $key => $value ) {
        $mail      = str_replace('{'.$key.'}', $value, $mail);
        $mail_from = str_replace('{'.$key.'}', $value, $mail_from);
        $subject   = str_replace('{'.$key.'}', $value, $subject);
        $body      = str_replace('{'.$key.'}', $value, $body);
    }
		$mailer->isHTML(true);
    $mailer->setFrom($mail_from, $mail_from_name);
    $mailer->addReplyTo($mail_from, $mail_from_name);
    $mailer->addAddress($mail);
    $mailer->Subject = $subject;
    $mailer->Body = $body;
    $result = $mailer->send();
    if (!$result) {
        error_log("send_mail: ".$mailer->ErrorInfo);
    }
    return $result;
}


function fh_reset_tmp(){
	$wrapper = '
		width: 380px;
		margin: 12px auto;
		color: #666;
		font-size: 16px
	';
	$p = '
		line-height: 26px;
		margin: 12px 0
	';
	$a = '
		color: #333;
	';
	$button = '
		display: block;
		background: #f43438;
		color: #fff;
		height: 48px;
		line-height: 48px;
		padding: 0 24px;
		font-size: 18px;
		border-radius: 3px;
		text-align: center;
		text-decoration: none;
	';
	$header = '';
	$body = '';
	$footer = '
		color: #abadae;
		font-size: 12px;
		margin-top: 12px;
		line-height: 24px
	';
	$footer_a = '
		color: #abadae;
		text-decoration: underline
	';
	return '
		<div style="'.$wrapper.'">
			<div style="'.$header.'">

			</div>
			<div style="'.$body.'">
				<p style="'.$p.'">Hi {login},</p>
				<p style="'.$p.'">We got a request to reset your Pollate password.</p>
				<p style="'.$p.'"><a href="{url}" style="'.$button.'">Reset your password</a></p>
				<p style="'.$p.'">If you ignore this message, your password will not be changed. If you didn\'t request a password reset, <a href="#" style="'.$a.'">let us know</a>.</p>
			</div>
			<div style="'.$footer.'">
				&copy; Pollate 2017<br />
				This message was sent to <a style="'.$footer_a.'">{mail}</a> and intended for {login}.
			</div>
		</div>
	';
}

function fh_site_title(){
	global $id, $type, $lang;
	$title = '';
	switch(page){
		case 'questions':
			$title = db_get('questions', 'question', $id).' | ';
			break;
		case 'profile':
			$title = db_get('users', 'username', $id).'\'s profile | ';
			break;
		case 'members':
			$title = $lang['header']['menu']['members'].' | ';
			break;
		case 'index':
			if($type == 'fresh')
				$title = $lang['header']['menu']['fresh'].' | ';
			elseif($type == 'popular')
				$title = $lang['header']['menu']['popular'].' | ';
			elseif($type == 'categories')
				$title = db_get('categories', 'title', $id).' | ';
			elseif($type == 'followed')
				$title = $lang['header']['menu']['followed'].' | ';
			break;
		case 'sign-up':
			$title = $lang['header']['up'].' | ';
			break;
	}

	return $title.site_title;
}

function fh_site_thumb(){
	global $id;
	$title = siteThumb;
	switch(page){
		case 'questions':
			$thumb = path.'/'.db_get('questions', 'thumbnail', $id);
			$title = ($thumb?$thumb:siteThumb);
			break;
		case 'profile':
			$thumb = db_get('users', 'photo', $id);
			$title = ($thumb?$thumb:siteThumb);
			break;
	}

	return $title;
}

function fh_footer_statistics($data, $other = false){
	global $lang;
	return str_replace('{count}', '<b>'.db_count($data.$other).'</b> ',$lang['footer']['statistics'][$data]);
}


function fh_cp_members_statistics($rs){
	global $lang;

	return '
	<div class=&quot;pl-row pl-chart-content&quot;>
		<div class=&quot;pl-col-6&quot;>
			<div class=&quot;nobr&quot;><i class=&quot;icon-question icons&quot;></i> '.db_unserialize([$rs, 'questions']).' Questions</div>
			<div class=&quot;nobr&quot;><i class=&quot;icon-bubbles icons&quot;></i> '.db_unserialize([$rs, 'comments']).' Comments</div>
			<div class=&quot;nobr&quot;><i class=&quot;icon-cup icons&quot;></i> '.db_unserialize([$rs, 'following']).' Folowing</div>
		</div>
			<div class=&quot;pl-col-6&quot;>
				<div class=&quot;nobr&quot;><i class=&quot;icon-star icons&quot;></i> '.db_unserialize([$rs, 'votes']).' Votes</div>
				<div class=&quot;nobr&quot;><i class=&quot;icon-people icons&quot;></i> '.db_unserialize([$rs, 'followers']).' Followers</div>
				<div class=&quot;nobr&quot;><i class=&quot;icon-tag icons&quot;></i> '.db_unserialize([$rs, 'tags']).' Tags</div>
			</div>
	</div>';
}


function fh_cp_question_statistics($rs){
	global $lang;

	return '
	<div class=&quot;pl-chart-content&quot;>
			<div class=&quot;nobr&quot;><i class=&quot;icon-star icons&quot;></i> '.db_unserialize([$rs, 'votes']).' Votes</div>
			<div class=&quot;nobr&quot;><i class=&quot;icon-bubbles icons&quot;></i> '.db_unserialize([$rs, 'comments']).' Comments</div>
			<div class=&quot;nobr&quot;><i class=&quot;icon-tag icons&quot;></i> '.db_unserialize([$rs, 'tags']).' Folowing</div>
	</div>';
}

function fh_birth_age($value, $time = ''){

	$day   = '';
	$month = '';
	$year  = '';
	if($value){
		$day   = db_unserialize([$value, 0]);
		$month = db_unserialize([$value, 1]);
		$year  = db_unserialize([$value, 2]);
	}
	$time  = $time ? $time : ($day && $month && $year ? strtotime("{$month}/{$day}/{$year}") : '');

	$age = floor((time() - $time) / 31556926);
  return $age;
}

function fh_check_date($d, $type){
	switch($type){
		case 'day':
			if(!$d || strlen($d)>2){
				return false;
			} elseif($d>31 || $d<1){
				return false;
			} else {
				return true;
			}
		break;
		case 'month':
			if(!$d || strlen($d)>2){
				return false;
			} elseif($d>12 || $d<1){
				return false;
			} else {
				return true;
			}
		break;
		case 'year':
			if(!$d || strlen($d)>4){
				return false;
			} elseif($d>2005 || $d<1942){
				return false;
			} else {
				return true;
			}
		break;
	}

}


function fh_stats_sex($id, $votes, $sex){
	$m = db_count("votes WHERE question = '{$id}' && sex = {$sex}");
	$n = $votes;
	return $n == 0 ? 0 : (int)(($m/$n)*100);
}

function fh_stats_percentage($n, $m){
	return $n == 0 ? 0 : (int)(($m/$n)*100);
}

function fh_statistics_update($t, $c, $id, $p = true, $us = false){
	$qs_statistics    = $us ? $us : db_get($t, 'statistics', $id);
	$qs_tags          = db_unserialize([$qs_statistics, $c]);
	$qs_statistics_up = db_serialize_update([$qs_statistics, $c, ($p?$qs_tags+1:$qs_tags-1)]);

	db_update($t, ["statistics" => "'".$qs_statistics_up."'"], $id);
}

function fh_social_login( $socialname, $profile ){
	global $lang;

	# google
	/*
    [id] => 102326558705345113428
    [email] => el.bouirtou@gmail.com
    [verified_email] => 1
    [name] => Khalid Puerto
    [given_name] => Khalid
    [family_name] => Puerto
    [link] => https://plus.google.com/+KhalidPuerto
    [picture] => https://lh3.googleusercontent.com/-HqZmVaMi9ms/AAAAAAAAAAI/AAAAAAAAAKo/086abwIMhfk/photo.jpg
    [gender] => male
    [locale] => en
	*/

	switch($socialname){
		case 'facebook':
			$socialid  = $profile['id'];
			$username  = $profile['name'];
			$firstname = $profile['first_name'];
			$lastname  = $profile['last_name'];
			$cover     = '';
			$email     = $profile['email'];
			$photo     = $profile['picture']['url'];
			$link      = ['facebook' => 'https://facebook.com/'.$profile['id']];
			$gender    = '';
			$description  = '';
		break;
		case 'google':
			$socialid  = $profile['id'];
			$username  = $profile['name'];
			$firstname = $profile['given_name'];
			$lastname  = $profile['family_name'];
			$cover     = '';
			$email     = $profile['email'];
			$photo     = $profile['picture'];
			$link      = ['google' => $profile['link']];
			$gender    = $profile['gender'] == 'male'? 1 : 2;
			$description  = '';
		break;
		case 'twitter':
			$socialid  = $profile->id;
			$username  = $profile->name;
			$firstname = '';
			$lastname  = '';
			$cover     = $profile->profile_banner_url;
			$email     = 'no email address';
			$photo     = $profile->profile_image_url;
			$link      = ['twitter' => 'https://twitter.com/'.$profile->screen_name];
			$gender    = '';
			$description  = $profile->description;
		break;
	}


	// id, name, first_name, last_name, email, picture{height,width,url}
	if(db_rows("users WHERE username = '{$username}' || email = '{$email}'")){
		$sql = db_select([
				'table'  => 'users',
				'column' => 'id, moderat',
				'where'  => '(username = "'.$username.'" || email = "'.$email.'") && social_name = "'.$socialname.'" && social_id = "'.$socialid.'"'
		]);
		if($sql->num_rows){
			$rs = $sql->fetch_assoc();
			$_SESSION['login']  = $rs['id'];
			db_update('users', ["photo"=>"'{$photo}'"], $rs['id']);
			echo fh_alerts($lang['login']['alert']['success'], "success");
			fh_go(path.'/index.php', 3);
		} else {
			echo fh_alerts($lang['login']['alert']['social'].$username.$socialname.$socialid);
		}
	} else {
		db_insert('users', [
			"username"    => "'{$username}'",
			"firstname"   => "'{$firstname}'",
			"lastname"    => "'{$lastname}'",
			"email"       => "'".($email == 'no email address' ? '' : $email)."'",
			"sex"         => "'{$gender}'",
			"cover"       => "'{$cover}'",
			"description" => "'{$description}'",
			"socials"     => "'".serialize($link)."'",
			"social_id"   => "'{$socialid}'",
			"social_name" => "'{$socialname}'",
			"photo"       => "'{$photo}'",
			"date"        => "'".time."'",
			"level"       => "'1'",
			'statistics'  => "'".serialize(['votes'=>0,'tags'=>0,'comments'=>0,'followers'=>0,'following'=>0,'questions'=>0])."'",
			'credits'     => "'".fh_creditSET('sign-up')."'"
		]);
		$_SESSION['login']  = db_get('users', 'id', $username, 'username', "&& social_name = '{$socialname}' && social_id = '{$socialid}'");
		echo fh_alerts($lang['login']['alert']['success'], "success");
		fh_go(path.'/index.php', 3);
	}
}

function fh_go($href = '',$tm = 0){
	echo '<meta http-equiv="refresh" content="'.$tm.'; URL='.$href.'">';
}



function puerto_social_login( $userslname, $userslid, $username, $email, $photo ){
	Global $db, $level;
	if(!puerto_check_lower(user_table,user_name,$username)){
		$data = array(
			user_name   => "'{$username}'",
			user_email  => "'{$email}'",
			user_slid   => "'{$userslid}'",
			user_slname => "'{$userslname}'",
			user_photo  => "'{$photo}'",
			user_date   => "'".time()."'",
			user_level  => "'{$level['user']}'"
		);
		puerto_insert( user_table, $data );
	}

	if(puerto_check_lower(user_table,user_name,$username)){
		$logins = $db->query("SELECT ".user_id." FROM ".user_table." WHERE ".user_name." = '{$username}' AND ".user_slid." = '{$userslid}' AND ".user_slname." = '{$userslname}'");
		if($logins->num_rows){
			$login = $logins->fetch_row();
			$data  = array( user_photo => "'{$photo}'" );
			puerto_update( user_table, $data, $login[0], user_id );
			$_SESSION['login'] = $login[0];
			echo puerto_msg("success","You are logged in successfully, We wish you a good time.");
			go("add.php",5);
		} else {
			echo puerto_msg("danger", "There is a problem with your social ID, the username you want to login with is not yours or already exist with a different social ID!");
			go("login.php",6);
		}
	} else {
		echo puerto_msg("danger",$lang['alert_wrong']);
		go("login.php",5);
	}
}

function fh_cp_trash($table, $tables = ''){
	global $id, $multi, $multi_ids, $lang;
	if(us_level == 6){
		if($multi){
			if(!$multi_ids){
				$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts('No data has being chosen', 'danger', false)
				];
			} else {
				foreach ($multi_ids as $key) {
					db_trash( $table, $key);
				}
				$alert = [
					'type'  =>'success',
					'alert' => fh_alerts($table.' has moved to trash successfully.', 'success', false)
				];
			}
		} else {
			if(!db_rows($table." WHERE id = '{$id}'")){
				$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
				];
			} else {
				db_trash( $table, $id);

				$alert = [
					'type'  =>'success',
					'alert' => fh_alerts($tables.' has been moved to trash successfully.', 'success', false)
				];
			}
		}
	} else {
		$alert = [
			'type'  =>'danger',
			'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
		];
	}
	return $alert;
}

function fh_cp_update($table, $type, $arr){
	global $id, $multi, $multi_ids, $lang;
	if(us_level == 6){
		if($multi){
			if(!$multi_ids){
				$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts('No data has being chosen', 'danger', false)
				];
			} else {
				foreach ($multi_ids as $key) {
					db_update( $table, $arr, $key);
				}
				$alert = [
					'type'  =>'success',
					'alert' => fh_alerts($table." has been {$type} successfully.", 'success', false)
				];
			}
		} else {
			if(!db_rows($table." WHERE id = '{$id}'")){
				$alert = [
					'type'  =>'danger',
					'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
				];
			} else {
				db_update( $table, $arr, $id);

				$alert = [
					'type'  =>'success',
					'alert' => fh_alerts(str_replace('s','',$table)." has been {$type} successfully.", 'success', false)
				];
			}
		}
	} else {
		$alert = [
			'type'  =>'danger',
			'alert' => fh_alerts($lang['alerts']['wrong'], 'danger', false)
		];
	}
	return $alert;
}
