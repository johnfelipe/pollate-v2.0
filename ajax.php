<?php
# -------------------------------------------------#
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
#	¤                                            ¤   #
#	¤         Pollogo - Poll script 1.0          ¤   #
#	¤--------------------------------------------¤   #
#	¤              By Khalid Puerto              ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Facebook : fb.com/prof.puertokhalid       ¤   #
#	¤  Instagram : instagram.com/khalidpuerto    ¤   #
#	¤  Site : http://www.puertokhalid.com        ¤   #
#	¤                                            ¤   #
#	¤--------------------------------------------¤   #
#	¤                                            ¤   #
#	¤  Last Update: 21/04/2020                   ¤   #
#	¤                                            ¤   #
#¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤¤#
# -------------------------------------------------#

include __DIR__.'/config.php';

switch($request){
    case 'lang': include(__DIR__.'/ajax/lang.php'); break;
    case 'login': include(__DIR__.'/ajax/login.php'); break;
    case 'logout': include(__DIR__.'/ajax/logout.php'); break;
    case 'more-comments': include(__DIR__.'/ajax/more-comments.php'); break;
    case 'password-forget': include(__DIR__.'/ajax/password-forget.php'); break;
    case 'password-reset': include(__DIR__.'/ajax/password-reset.php'); break;
    case 'register': include(__DIR__.'/ajax/register.php'); break;
    case 'send-comment': include(__DIR__.'/ajax/send-comment.php'); break;
    case 'send-credits': include(__DIR__.'/ajax/send-credits.php'); break;
    case 'send-details': include(__DIR__.'/ajax/send-details.php'); break;
    case 'send-question': include(__DIR__.'/ajax/send-question.php'); break;
    case 'send-password': include(__DIR__.'/ajax/send-password.php'); break;
    case 'send-report': include(__DIR__.'/ajax/send-report.php'); break;
    case 'send-vote': include(__DIR__.'/ajax/send-vote.php'); break;
    case 'send-vote-answer': include(__DIR__.'/ajax/send-vote-answer.php'); break;
    case 'search': include(__DIR__.'/ajax/search.php'); break;
    case 'sidebar-questions': include(__DIR__.'/ajax/sidebar-questions.php'); break;
    case 'subscribe': include(__DIR__.'/ajax/subscribe.php'); break;
    case 'upload': include(__DIR__.'/ajax/upload.php'); break;


    case 'actions': include(__DIR__.'/ajax/actions.php'); break;

		# Cpanel
    case 'send-category': include(__DIR__.'/ajax/send-category.php'); break;
    case 'send-plan': include(__DIR__.'/ajax/send-plan.php'); break;
    case 'send-page': include(__DIR__.'/ajax/send-page.php'); break;
    case 'sort-page':
			$arr = sc_array($_POST['sort'], 'int');
			foreach ($arr as $k => $v) {
				db_update("pages", ['sort' => "'".($k+1)."'"], $v);
			}
		break;





    case 'adminstatsbars':


		if(us_level == 6){
			if($pg == "daily"){
				$start = new DateTime('now');
				$end = new DateTime('- 7 day');
				$diff = $end->diff($start);
				$interval = DateInterval::createFromDateString('-1 day');
				$period = new DatePeriod($start, $interval, $diff->days);

				foreach ($period as $date) {
					$aa['data'][] = db_rows("questions WHERE FROM_UNIXTIME(date,'%m-%d-%Y') = '".$date->format('m-d-Y')."'");
					$aa['labels'][] = $date->format('M d');
					$colors = randomColor();
					$aa['colors'][] = "#".$colors['hex'];
				}

			  $aa['data'] = array_reverse($aa['data']);
			  $aa['labels'] = array_reverse($aa['labels']);
			  $aa['title'] = "Question in the last 7 days";
			} elseif($pg == "monthly"){
				$aa = [];
				for ($i=1; $i <=12 ; $i++) {
					$aa['data'][] = db_rows("questions WHERE MONTH(FROM_UNIXTIME(date)) = '{$i}'");
					$aa['labels'][] = date('F', mktime(0, 0, 0, $i, 10));
					$colors = randomColor();
					$aa['colors'][] = "#".$colors['hex'];
				}
			  $aa['title'] = "Question in the last 12 months";
			} elseif($pg == "years"){
				$now = date('Y');
				$then = $now - 10;

				$aa = [];
				for ($i=$now; $i >=$then ; $i--) {
					$aa['data'][] = db_rows("questions WHERE YEAR(FROM_UNIXTIME(date)) = '{$i}'");
					$aa['labels'][] = $i;
					$colors = randomColor();
					$aa['colors'][] = "#".$colors['hex'];
				}
			  $aa['title'] = "Question in the last 10 years";

			  $aa['data'] = array_reverse($aa['data']);
			  $aa['labels'] = array_reverse($aa['labels']);
			}
			echo json_encode($aa);
		}




		break;


    case 'adminstatspie':


		if(us_level == 6){

				$ages = [
				 "< 18"  => "age BETWEEN '13' AND '18'",
				 "18-25" => "age BETWEEN '18' AND '25'",
				 "26-36" => "age BETWEEN '26' AND '35'",
				 "36-50" => "age BETWEEN '36' AND '50'",
				 "> 50"  => "age > '50'"
			 ];

				$aa = [];
				foreach ($ages as $k => $age) {
					$aa['data'][] = db_rows("votes WHERE {$age}");
					$aa['labels'][] = $k;
					$colors = randomColor();
					$aa['colors'][] = "#".$colors['hex'];
				}
			  $aa['title'] = "Votes By Ages";

			echo json_encode($aa);
		}




		break;


    case 'adminstatshbars':


		if(us_level == 6){

				$ages = [
				 "Male",
				 "Female"
			 ];

				$aa = [];
				foreach ($ages as $k => $age) {
					$aa['data'][] = db_rows("votes WHERE sex = '{$k}'");
					$aa['labels'][] = $age;
					$colors = randomColor();
					$aa['colors'][] = "#".$colors['hex'];
				}
			  $aa['title'] = "Votes By Gender";

			echo json_encode($aa);
		}




		break;
    case 'adminstats':


		if(us_level == 6){
		if($pg == "daily"){
			$start = new DateTime('now');
			$end = new DateTime('- 7 day');
			$diff = $end->diff($start);
			$interval = DateInterval::createFromDateString('-1 day');
			$period = new DatePeriod($start, $interval, $diff->days);

			foreach ($period as $date) {
				$aa['data'][] = db_rows("votes WHERE FROM_UNIXTIME(date,'%m-%d-%Y') = '".$date->format('m-d-Y')."'");
				$aa['labels'][] = $date->format('M d');
			}

		  $aa['data'] = array_reverse($aa['data']);
		  $aa['labels'] = array_reverse($aa['labels']);
		  $aa['title'] = 'Votes in the last 7 days';
		} elseif($pg == "monthly"){
			$aa = [];
			for ($i=1; $i <=12 ; $i++) {
				$aa['data'][] = db_rows("votes WHERE MONTH(FROM_UNIXTIME(date)) = '{$i}'");
				$aa['labels'][] = date('F', mktime(0, 0, 0, $i, 10));
			}
		  $aa['title'] = 'Votes in the last 12 months';
		} elseif($pg == "years"){
			$now = date('Y');
			$then = $now - 10;

			$aa = [];
			for ($i=$now; $i >=$then ; $i--) {
				$aa['data'][] = db_rows("votes WHERE YEAR(FROM_UNIXTIME(date)) = '{$i}'");
				$aa['labels'][] = $i;
				$colors = randomColor();
				$aa['colors'][] = "#".$colors['hex'];
			}
			$aa['title'] = "Votes in the last 10 years";

			$aa['data'] = array_reverse($aa['data']);
			$aa['labels'] = array_reverse($aa['labels']);
		}
		echo json_encode($aa);
	}


		break;




		case 'world':
		if(us_level == 6){

				$aa = [];
				foreach ($countries as $k => $c) {
					$aa[$k] = db_rows("votes WHERE country = '{$k}'");
				}

			echo json_encode($aa);
		}
		break;

		case 'question-gender':
				$ages = [ 1 => $lang['register']['gender']['male'], 2 => $lang['register']['gender']['female'] ];

				$aa = [];
				foreach ($ages as $k => $age) {
					$aa['data'][] = db_rows("votes WHERE sex = '{$k}' && question = '{$id}'");
					$aa['labels'][] = $age;
					$colors = randomColor();
					$aa['colors'][] = "#".$colors['hex'];
				}
			  $aa['title'] = "";
			  $aa['id'] = $id;

			echo json_encode($aa);
		break;

		case 'question-age':
				$ages = [
					"< 18"  => "age BETWEEN '13' AND '18'",
					"18-25" => "age BETWEEN '18' AND '25'",
					"26-36" => "age BETWEEN '26' AND '35'",
					"36-50" => "age BETWEEN '36' AND '50'",
					"> 50"  => "age > '50'"
				];

				$aa = [];
				foreach ($ages as $k => $age) {
					$aa['data'][] = db_rows("votes WHERE {$age}");
					$aa['labels'][] = $k;
					$colors = randomColor();
					$aa['colors'][] = "#".$colors['hex'];
				}
			  $aa['title'] = "Votes By Ages";

			echo json_encode($aa);
		break;





    case 'send-lang': include(__DIR__.'/ajax/send-lang.php'); break;
    case 'send-setting': include(__DIR__.'/ajax/send-setting.php'); break;
}
