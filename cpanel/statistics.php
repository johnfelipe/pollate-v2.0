<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-chart icons"></i> Statistics</h3>
			<p><a href="<?=path?>/cpanel.php">Cpanel</a> / Questions / <?=db_get('questions','question',$id)?></p>
		</div>
			<div class="pl-col-6 text-right">
				<a href="<?=path?>/cpanel.php?type=questions" class="pl-buttons bg-9"><i class="fas fa-arrow-left"></i> Back</a>
				<a href="#" data-name="<?=fh_seoURLCheck(db_get('questions','question',$id))?>" class="pl-buttons bg-0 stats-download"><i class="fas fa-floppy"></i> Download PDF</a>
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
<div class="pl-cpanel-box" id="root">
	<div>
		<h3><?=$dbrs['question']?></h3>
		<p class="pl-chart-content">
			<i class="icon-star icons"></i> <?=db_unserialize([$dbrs['statistics'], 'votes'])?> Votes
			<i class="icon-bubbles icons"></i> <?=db_unserialize([$dbrs['statistics'], 'comments'])?> Comments
			<i class="icon-tag icons"></i> <?=db_unserialize([$dbrs['statistics'], 'tags'])?> Folowing
		</p>
	</div>

	<h5 class="cp-stats-h5">Statistics by Gender</h5>
	<div class="row">
		<div class="col-8">

		</div>
		<div class="col-4">

		</div>
	</div>
	<table class="table">
	  <tbody>
	    <tr>
	      <td width="85%">
					<table class="table">
					  <tbody>
					    <tr>
					      <td width="85%">Male</td>
					      <td width="15%" class="text-center"><?=fh_stats_sex($id, db_count("votes WHERE question = '$id' && sex != 0"), 1)?>%</td>
					    </tr>
					    <tr>
					      <td width="85%">Female</td>
					      <td width="15%" class="text-center"><?=fh_stats_sex($id, db_count("votes WHERE question = '$id' && sex != 0"), 2)?>%</td>
					    </tr>
					  </tbody>

					</table>
	      </td>
	      <td width="15%">
					<div class="pt-charts">
						<div class="pt-adminstats">
							<canvas id="hbar-chart"></canvas>
						</div>

					</div>
	      </td>
	    </tr>
	  </tbody>

	</table>

	<h5 class="cp-stats-h5">Statistics by Age</h5>
	<table class="table">
	  <tbody>
	    <tr>
	      <td width="85%">
					<table class="table">
					  <tbody>
					    <tr>
					      <td width="85%">13-18</td>
					      <td width="15%" class="text-center">
									<?=db_count("votes WHERE question = '{$id}' && age < '18'")?> votes
									(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age < '18'"))?>%)
								</td>
					    </tr>
					    <tr>
					      <td width="85%">18-25</td>
								<td width="15%" class="text-center">
									<?=db_count("votes WHERE question = '{$id}' && age BETWEEN '18' AND '25'")?> votes
									(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age BETWEEN '18' AND '25'"))?>%)
								</td>
					    </tr>
					    <tr>
					      <td width="85%">25-35</td>
								<td width="15%" class="text-center">
									<?=db_count("votes WHERE question = '{$id}' && age BETWEEN '26' AND '35'")?> votes
									(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age BETWEEN '26' AND '35'"))?>%)
								</td>
					    </tr>
					    <tr>
					      <td width="85%">35-50</td>
								<td width="15%" class="text-center">
									<?=db_count("votes WHERE question = '{$id}' && age BETWEEN '36' AND '50'")?> votes
									(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age BETWEEN '36' AND '50'"))?>%)
								</td>
					    </tr>
					    <tr>
					      <td width="85%">+50</td>
								<td width="15%" class="text-center">
									<?=db_count("votes WHERE question = '{$id}' && age > '50'")?> votes
									(<?=fh_stats_percentage(db_unserialize([$dbrs['statistics'], 'votes']), db_count("votes WHERE question = '{$id}' && age > '50'"))?>%)
								</td>
					    </tr>
					  </tbody>
					</table>
	      </td>
	      <td width="15%">
					<div class="pt-charts">
						<div class="pt-adminstats">
							<canvas id="pie-chart"></canvas>
						</div>

					</div>
	      </td>
	    </tr>
	  </tbody>

	</table>




	<h5 class="cp-stats-h5">Statistics by Location</h5>
	<table class="table">
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
								title="<?=(isset($rs['country']) && array_key_exists($rs['country'], $countries)?$countries[$rs['country']]:'No Country')?>">
					</span>
					<?=(isset($rs['country']) && array_key_exists($rs['country'], $countries)?$countries[$rs['country']]:'No Country')?>
				</td>
				<!--<td width="85%"><?=($rs['city']?$tr_cities[$rs['city']]:'--')?></td>-->
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

	<h5 class="cp-stats-h5">List of Voters</h5>
	<table class="table">
		  <thead class="thead-default">
			    <tr>
				      <th class="text-left">User Name</th>
				      <th>Country</th>
				      <th>City</th>
				      <th>Gender</th>
				      <th>Voting Date</th>
				      <th>Birth date</th>
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
									<h3 class="pl-title"><?=($rs['author']?fh_user($rs['author']):'<a>(visitor)</a>')?></h3>
									<!-- <small>
											<?=(db_unserialize([$rs['address'], 1])?db_unserialize([$rs['address'], 1]):'--')?>
											<?=(db_unserialize([$rs['address'], 2])?' - '.db_unserialize([$rs['address'], 2]):'--')?>
									</small> -->
								</td>
					      <td width="5%" class="text-center"><?=($rs['country']?$countries[$rs['country']]:'--')?></td>
					      <td width="5%" class="text-center">--</td>
					      <td width="5%" class="text-center"><?=fh_sex($rs['sex'])?></td>
					      <td width="20%" class="text-center"><?=fh_ago($rs['date'])?></td>
					      <td width="20%" class="text-center"><?=fh_birth($rs['birth'])?> (<?=fh_birth_age($rs['birth'])?>)</td>
				    </tr>
						<?php endwhile;?>
			  </tbody>
		</table>

		<?php $sql->close();?>
</div>
