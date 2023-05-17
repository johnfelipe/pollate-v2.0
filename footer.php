    		<?php if( $sidebar['access'] ) include __DIR__.'/sidebar.php'; ?>
				<div id="pl-vote-fieldsmodal"></div>
		</div><!-- End Container -->
</div><!-- End Page -->

<div class="pl-footer">
    <div class="pl-container">
        <div class="pl-links">
            <h3><?=$lang['footer']['links']?>:</h3>
            <ul>
                <?php
                $sql = db_select([
                    'table' => 'pages',
                    "where" => "trash = 0 && footer = 0",
                    'order' => 'ORDER BY sort ASC'
                ]);
                if($sql->num_rows):
                $i = 1;
                while($rs = $sql->fetch_assoc()):
                ?>
                <li><a href="<?=path?>/pages.php?id=<?=fh_seoURL($rs['id'], 'pages', $rs['title'])?>"><?=$rs['title']?></a></li>
                <?php
                $i++;
                if($i==6){
                    echo'</ul><ul class="list nn-m">';
                    $i=0;
                }
                endwhile;
                endif;
                $sql->close();
                ?>
            </ul>
        </div><!-- End Links -->
        <div class="pl-subsecribe">
            <h3><?=$lang['footer']['subscribe']['title']?>:</h3>
            <div class="pl-subs">
							<form id="subscribe">
                <p><?=$lang['footer']['subscribe']['p']?></p>
                <div class="pl-group-inp">
                  <input type="text" name="email" placeholder="<?=$lang['footer']['subscribe']['place']?>">
                  <i class="fas fa-at"></i>
                </div>
                <button type="submit" class="pl-buttons bg-0">
                  <span><i class="fas fa-follow"></i> <?=$lang['footer']['subscribe']['button']?></span>
                </button>
							</form>
            </div>
        </div><!-- End Subsecribe -->
        <div class="pl-statistics">
            <h3><?=$lang['footer']['statistics']['title']?>:</h3>
						<ul>
							<li><i class="icon-people icons"></i> <?=fh_footer_statistics('users', ' WHERE trash = 0')?></li>
							<li><i class="icon-question icons"></i> <?=fh_footer_statistics('questions', ' WHERE trash = 0')?></li>
							<li><i class="icon-like icons"></i> <?=fh_footer_statistics('votes', ' WHERE trash = 0')?></li>
							<li><i class="icon-bubbles icons"></i> <?=fh_footer_statistics('comments', ' WHERE trash = 0')?></li>
							<li><i class="icon-emotsmile icons"></i> <?=fh_footer_statistics('answers', ' WHERE trash = 0')?></li>
						</ul>
        </div><!-- End Statistics -->
    </div><!-- End Container -->
</div><!-- End Footer -->

<div class="pl-copyright">
    <div class="pl-container">
				<?php if(db_rows("lang WHERE trash = 0")): ?>
				<div class="pl-lang">
					<?php
					$sql = $db->query("SELECT * FROM ".prefix."lang WHERE trash = 0");
					if($sql->num_rows):
						while($rs = $sql->fetch_assoc()):
					?>
					<a href="#" rel="<?=$rs['id']?>" title="<?=$rs['fullname']?>">
						<span class="flag-icon flag-icon-<?=$rs['shortname']?> flag-icon-squared"></span>
					</a>
					<?php
						endwhile;
					endif;
					$sql->close();
					?>
				</div>
				<?php endif; ?>
        Copyright &copy; <?=date('Y', time())?> <a href="<?=path?>">Pollate</a>. All Rights Reserved.<br>
        Programming and design by <a href="http://puertokhalid.com" target="_blanc">Puerto Khalid</a>.
    </div><!-- End Container -->
</div>

<?php if(!us_level): ?>
<?php include(__DIR__.'/partials/sign-in.php'); ?>
<?php include(__DIR__.'/partials/password-forget.php'); ?>
<?php else: ?>
<?php include(__DIR__.'/partials/report.php'); ?>
<?php include(__DIR__.'/partials/password.php'); ?>
<?php endif; ?>

<!-- jQuery Libraries -->
<?php
# Header Page
include __DIR__.'/scripts.php';
?>
</body>
</html>
