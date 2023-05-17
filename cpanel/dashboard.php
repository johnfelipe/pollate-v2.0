<div class="pl-cpanel-heading">
	<div class="pl-row">
		<div class="pl-col-6 pl-cpanel-title">
			<h3><i class="icon-grid icons"></i> Dashboard</h3>
			<p><a href="<?=path?>/cpanel.php">Cpanel</a> / Dashboard</p>
		</div>
			<div class="pl-col-6 text-right">
			</div>
	</div>
</div>

<div class="pl-cpanel-box">
	<div class="pl-cpanel-statistics">
			<ul>
				<li class="bg-6"><i class="icon-people icons"></i> <?=fh_footer_statistics('users', ' WHERE trash = 0')?></li>
				<li class="bg-2"><i class="icon-question icons"></i> <?=fh_footer_statistics('questions', ' WHERE trash = 0')?></li>
				<li class="bg-8"><i class="icon-like icons"></i> <?=fh_footer_statistics('votes', ' WHERE trash = 0')?></li>
				<li class="bg-4"><i class="icon-bubbles icons"></i> <?=fh_footer_statistics('comments', ' WHERE trash = 0')?></li>
				<li class="bg-13"><i class="icon-emotsmile icons"></i> <?=fh_footer_statistics('answers', ' WHERE trash = 0')?></li>
				<li class="bg-7"><i class="icon-support icons"></i> <b><?=db_count('subscribers')?></b> Subscribers</li>
				<li class="bg-11"><i class="icon-ban icons"></i> <b><?=db_count('reports')?></b> Reports</li>
				<li class="bg-5"><i class="icon-organization icons"></i> <b><?=db_count('categories')?></b> Categories</li>
			</ul>
	</div><!-- End Statistics -->

	<div class="row">
		<div class="col-4">
			<div class="pt-charts pt-worldss">
				<table class="table table-bordered">
					<?php
					$sql = $db->query("SELECT country, count(country) as m FROM ".prefix."votes GROUP BY country ORDER by count(country) DESC LIMIT 8") or die ($db->error);
					while($rs = $sql->fetch_assoc()):
					?>
					<tr>
						<td>
							<span class="flag-icon flag-icon-<?=($rs['country']?strtolower($rs['country']):'nop')?>"
										title="<?=(isset($rs['country']) && array_key_exists($rs['country'], $countries)?$countries[$rs['country']]:'No Country')?>">
							</span>
							<?=(isset($rs['country']) && array_key_exists($rs['country'], $countries)?$countries[$rs['country']]:'No Country')?>
							<span class="float-right"><?=$rs['m']?> <small>votes</small></span>
							</td>
					</tr>
					<?php endwhile;?>
				</table>
			</div>
		</div>
		<div class="col-8">
			<div class="pt-charts pt-worldss">
				<div class="world" id="world-map"></div>
			</div>
		</div>
	</div>


	<div class="row">
		<div class="col-6">
			<div class="pt-charts">
				<div class="pt-adminlines">
					<a href="#daily" rel="1">Days</a>
					<a href="#monthly" rel="1">Months</a>
					<a href="#years" rel="1">Years</a>
				</div>
				<div class="pt-adminstats">
					<canvas id="line-chart" width="800" height="450"></canvas>
				</div>
			</div>
		</div>
		<div class="col-6">
			<div class="pt-charts">
				<div class="pt-adminbars">
					<a href="#daily" rel="1">Days</a>
					<a href="#monthly" rel="1">Months</a>
					<a href="#years" rel="1">Years</a>
				</div>
				<div class="pt-adminstats">
					<canvas id="bar-chart" width="800" height="450"></canvas>
				</div>

			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-6">
			<div class="pt-charts">
				<div class="pt-adminstats">
					<canvas id="hbar-chart" width="800" height="450"></canvas>
				</div>
			</div>
		</div>
		<div class="col-6">

			<div class="pt-charts">
				<div class="pt-adminstats">
					<canvas id="pie-chart" width="800" height="450"></canvas>
				</div>

			</div>
		</div>
	</div>



	<div class="pl-row">
		<div class="pl-col-4">
			<div class="pl-cpanel-latest">
				<h3>Latest Comments (24h): <span><?=db_count("comments WHERE trash = 0 && date > ".(time - 3600*24)."")?></span></h3>
				<ul>
					<?php
			    $sql = db_select([
			        'table'  => 'comments AS c',
			        'join'   => 'users AS u ON(c.author=u.id)',
			        'column' => 'c.question, c.id, c.votes, c.author, c.date, c.content, u.photo',
			        'where'  => 'c.trash = 0 && c.date > '.(time - 3600*24).'',
			        'order'  => 'GROUP BY c.id ORDER BY c.id DESC LIMIT 100'
			    ]);
			    ?>
					<?php if($sql->num_rows): ?>
					<?php while($rs = $sql->fetch_assoc()): ?>
					<li>
						<div class="media pl-comment">
								<div class="media-left">
										<div class="pl-thumb">
												<img src="<?=$rs['photo']?>" alt="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=fh_thumbERROR('user')?>'" />
										</div>
								</div>
								<div class="media-body">
										<div class="pl-title">By <?=fh_user($rs['author'])?> <span><?=fh_ago($rs['date'])?></span></div>
										<div class="pl-cmt-content"><?=$rs['content']?></div>
								</div>
						</div>
					</li>
					<?php endwhile; ?>
					<?php else: ?>
					<li class="pl-not-found pl-box"><?=$lang['alerts']['no-data']?></li>
					<?php endif; ?>
					<?php $sql->close(); ?>
				</ul>
			</div>
		</div>
		<div class="pl-col-4">
			<div class="pl-cpanel-latest">
				<h3>Latest Questions (24h): <span><?=db_count("questions WHERE trash = 0 && date > ".(time - 3600*24)."")?></span></h3>
				<ul>
					<?php
					$sql = db_select([
							"table" => "questions",
							"where" => "trash = 0 && date > ".(time - 3600*24)."",
							'order' => 'ORDER BY id DESC LIMIT 100'
					]);
			    ?>
					<?php if($sql->num_rows): ?>
					<?php while($rs = $sql->fetch_assoc()): ?>
					<li>
						<div class="media pl-comment">
								<div class="media-left">
										<div class="pl-thumb">
												<img src="<?=$rs['thumbnail']?>" alt="<?=fh_user($rs['author'], false)?>" onerror="this.src='<?=fh_thumbERROR('thumb')?>'" />
										</div>
								</div>
								<div class="media-body">
									<div class="pl-title"><?=$rs['question']?></div>
									<div class="pl-cmt-content">By <?=fh_user($rs['author'])?> <span><?=fh_ago($rs['date'])?></span></div>
								</div>
						</div>
					</li>
					<?php endwhile; ?>
					<?php else: ?>
					<li class="pl-not-found pl-box"><?=$lang['alerts']['no-data']?></li>
					<?php endif; ?>
					<?php $sql->close(); ?>
				</ul>
			</div>
		</div>
		<div class="pl-col-4">
			<div class="pl-cpanel-latest">
				<h3>Latest Members (24h): <span><?=db_count("users WHERE trash = 0 && date > ".(time - 3600*24)."")?></span></h3>
				<ul>
					<?php
					$sql = db_select([
							"table" => "users",
							"where" => "trash = 0 && date > ".(time - 3600*24)."",
							'order' => 'ORDER BY id DESC LIMIT 100'
					]);
			    ?>
					<?php if($sql->num_rows): ?>
					<?php while($rs = $sql->fetch_assoc()): ?>
					<li>
						<div class="media pl-comment">
								<div class="media-left">
										<div class="pl-thumb">
												<img src="<?=$rs['photo']?>" alt="<?=$rs['username']?>" onerror="this.src='<?=fh_thumbERROR('user')?>'" />
										</div>
								</div>
								<div class="media-body">
									<div class="pl-title"><?=fh_user($rs['id'])?></div>
									<div class="pl-cmt-content"><?=fh_ago($rs['date'])?></span></div>
								</div>
						</div>
					</li>
					<?php endwhile; ?>
					<?php else: ?>
					<li class="pl-not-found pl-box"><?=$lang['alerts']['no-data']?></li>
					<?php endif; ?>
					<?php $sql->close(); ?>
				</ul>
			</div>
		</div>
	</div>
</div>
