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

# Header Page
include __DIR__.'/header.php';

if(!db_rows("questions WHERE id = '{$id}' && author = '".us_id."'") && us_level != 6){
	echo fh_alerts($lang['alerts']['wrong']);
	$sidebar = false;
	include __DIR__.'/footer.php';
	exit;
}


# Main Page
?>
<div class="pl-main">
	<div class="pl-cpanel-heading">
		<div class="pl-row">
			<div class="pl-col-6 pl-cpanel-title">
				<h3><i class="icon-chart icons"></i> <?=$lang['statistics']['title']?></h3>
				<p><?=$lang['members']['questions']?> / <?=db_get('questions','question',$id)?></p>
			</div>
				<div class="pl-col-6 text-right">
					<?php if(fh_planAccess('export')): ?>
					<a href="#" data-name="<?=fh_seoURLCheck(db_get('questions','question',$id))?>" class="pl-buttons bg-0 stats-download"><i class="fas fa-floppy"></i> <?=$lang['statistics']['btn']?></a>
					<?php endif; ?>
				</div>
		</div>
	</div>
	<?php
	$dbrs = null;
	if($id){
			$dbrs = db_rs(db_select([
					"table" => "questions",
					"where" => "id = '{$id}' && trash = 0"
			]));
	}
	?>
	<div class="pl-box p-4" id="root">
		<div>
			<h3><?=$dbrs['question']?></h3>
			<p class="pl-chart-content">
				<i class="icon-star icons"></i> <?=db_unserialize([$dbrs['statistics'], 'votes'])?> <?=$lang['members']['votes']?>
				<i class="icon-bubbles icons ml-3"></i> <?=db_unserialize([$dbrs['statistics'], 'comments'])?> <?=$lang['members']['comments']?>
				<i class="icon-tag icons ml-3"></i> <?=db_unserialize([$dbrs['statistics'], 'tags'])?> <?=$lang['members']['following']?>
			</p>
		</div>

		<h5 class="cp-stats-h5"><?=$lang['statistics']['byanswers']?></h5>
		<?php
		$sql = db_select([
	    'table' => 'answers',
	    'where' => 'question = '. $id
	  ]);
	  if($sql->num_rows){
	    while($rs = $sql->fetch_assoc()){
				$color = randomColor();
				$votes = db_rows("votes WHERE answer = '{$rs['id']}'");
				if($votes){
		      echo '
					<div class="pt-answer-stats">
						<div class="mb-3">
							<b>'.$rs['answer'].'</b>
							<div class="pt-l1">
								<span class="pt-l2" style="width: '.fh_percentage($rs['id'], $id).'%; background: #'.$color['hex'].'">
									<small style="background: #'.$color['hex'].'">'.fh_percentage($rs['id'], $id).'%</small>
								</span>
							</div>
						</div>
				  </div>';
				}
	    }
	  }

		?>

		<?php if(fh_planAccess('gender')): ?>
		<h5 class="cp-stats-h5"><?=$lang['statistics']['bygender']?></h5>

		<table class="table table-bordered">
			<tbody>
				<tr>
					<td width="85%" class="td-m">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td width="85%"><?=$lang['register']['gender']['male']?></td>
									<td width="15%" class="text-center"><?=fh_stats_sex($id, db_count("votes WHERE question = '$id' && sex != 0"), 1)?>%</td>
								</tr>
								<tr>
									<td width="85%"><?=$lang['register']['gender']['female']?></td>
									<td width="15%" class="text-center"><?=fh_stats_sex($id, db_count("votes WHERE question = '$id' && sex != 0"), 2)?>%</td>
								</tr>
							</tbody>

						</table>
					</td>
					<td width="15%" class="td-m">
						<div class="pt-charts">
							<div class="pt-question-gender">
								<canvas id="question-gender" rel="<?=$id?>"></canvas>
							</div>
						</div>
					</td>
				</tr>
			</tbody>

		</table>
		<?php endif; ?>

		<?php if(fh_planAccess('age')): ?>
		<h5 class="cp-stats-h5 html2pdf__page-break"><?=$lang['statistics']['byage']?></h5>
		<table class="table table-bordered">
			<tbody>
				<tr>
					<td width="85%" class="td-m">
						<table class="table table-bordered">
							<tbody>
								<tr>
									<td width="85%">13-18</td>
									<td width="15%" class="text-center text-nowrap">
										<?=db_count("votes WHERE question = '{$id}' && age < '18'")?> <?=$lang['members']['votes']?>
										(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age < '18'"))?>%)
									</td>
								</tr>
								<tr>
									<td width="85%">18-25</td>
									<td width="15%" class="text-center text-nowrap">
										<?=db_count("votes WHERE question = '{$id}' && age BETWEEN '18' AND '25'")?> <?=$lang['members']['votes']?>
										(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age BETWEEN '18' AND '25'"))?>%)
									</td>
								</tr>
								<tr>
									<td width="85%">25-35</td>
									<td width="15%" class="text-center text-nowrap">
										<?=db_count("votes WHERE question = '{$id}' && age BETWEEN '26' AND '35'")?> <?=$lang['members']['votes']?>
										(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age BETWEEN '26' AND '35'"))?>%)
									</td>
								</tr>
								<tr>
									<td width="85%">35-50</td>
									<td width="15%" class="text-center text-nowrap">
										<?=db_count("votes WHERE question = '{$id}' && age BETWEEN '36' AND '50'")?> <?=$lang['members']['votes']?>
										(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age BETWEEN '36' AND '50'"))?>%)
									</td>
								</tr>
								<tr>
									<td width="85%">+50</td>
									<td width="15%" class="text-center">
										<?=db_count("votes WHERE question = '{$id}' && age > '50'")?> <?=$lang['members']['votes']?>
										(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age > '50'"))?>%)
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td width="15%" class="td-m">
						<div class="pt-charts">
							<div class="pt-question-age">
								<canvas id="question-age" rel="<?=$id?>"></canvas>
							</div>

						</div>
					</td>
				</tr>
			</tbody>

		</table>
		<?php endif; ?>

		<?php if(fh_planAccess('location')): ?>

		<h5 class="cp-stats-h5 html2pdf__page-break"><?=$lang['statistics']['bylocation']?></h5>
		<table class="table table-bordered">
			<tbody>
				<?php
				$sql = db_select([
						"column" => "country",
						"table" => "votes",
						"where" => "question = '{$id}'",
						'order' => 'GROUP BY country ORDER BY country DESC'
				]);
				if($sql->num_rows):
				while($rs = $sql->fetch_assoc()):
				?>
				<tr>
					<td width="85%">
						<span class="flag-icon flag-icon-<?=($rs['country']?strtolower($rs['country']):'nop')?>"
									title="<?=(isset($rs['country']) && array_key_exists($rs['country'], $countries)?$countries[$rs['country']]:$lang['statistics']['nocountry'])?>">
						</span>
						<?=(isset($rs['country']) && array_key_exists($rs['country'], $countries)?$countries[$rs['country']]:$lang['statistics']['nocountry'])?>
					</td>
					<td width="15%" class="text-center">
						<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && country = '{$rs['country']}'"))?>%
					</td>
				</tr>
				<?php endwhile;?>
				<?php else:?>
					<tr>
						<td>No data!</td>
					</tr>
				<?php endif; ?>

				<?php $sql->close(); ?>
			</tbody>
		</table>

		<?php endif; ?>

		<h5 class="cp-stats-h5 html2pdf__page-break"><?=$lang['statistics']['list']?></h5>
		<div class="table-responsive">
		<table class="table border">
				<thead class="thead-default">
						<tr>
								<th class="text-left"><?=$lang['statistics']['username']?></th>
								<th class="text-center"><?=$lang['statistics']['gender']?></th>
								<th class="text-center"><?=$lang['statistics']['votingdate']?></th>
								<th class="text-center"><?=$lang['statistics']['age']?></th>
						</tr>
					</thead>
					<tbody>
							<?php
							$sql = db_select([
									"table" => "votes",
									"where" => "question = '{$id}'",
									'order' => 'ORDER BY id DESC'
							]);
							while($rs = $sql->fetch_assoc()):
							?>
							<tr>
									<td width="45%" class="text-left">
										<div>
											<?=($rs['author']?fh_user($rs['author']):'<a>('.$lang['statistics']['visitor'].')</a>')?>
										</div>
										<small>
											<span class="mr-1 flag-icon flag-icon-<?=($rs['country']?strtolower($rs['country']):'nop')?>"
														title="<?=(isset($rs['country']) && array_key_exists($rs['country'], $countries)?$countries[$rs['country']]:$lang['statistics']['nocountry'])?>">
											</span>
												<?=($rs['country']?$countries[$rs['country']]:'--')?>
												<?=($rs['city'] && $rs['city'] != '--'?$rs['city']:'')?>
										</small>
									</td>
									<td width="5%" class="text-center"><?=fh_sex($rs['sex'])?></td>
									<td width="20%" class="text-center text-nowrap"><?=date("M d, Y",$rs['date'])?></td>
									<td width="20%" class="text-center"><?=fh_birth_age($rs['birth'])?></td>
							</tr>
							<?php endwhile;?>
					</tbody>
			</table>
		</div>

			<?php $sql->close();?>
	</div>

</div><!-- End Main -->

<?php
$sidebar = [
	'access'     => true,
	'ads'        => true,
	'questions'  => false,
	'categories' => false,
	'social'     => true,
	'people'     => true
];

# Footer Page
include __DIR__.'/footer.php';
