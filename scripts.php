<script src="<?=path?>/js/jquery-3.4.1.min.js"></script>
<?php if(page == 'ask'): ?>
<script src="<?=path?>/js/datepicker.min.js"></script>
<script src="<?=path?>/js/datepicker.en.js"></script>
<?php endif; ?>
<script src="<?=path?>/js/popper.min.js"></script>
<script src="<?=path?>/js/bootstrap.min.js"></script>
<script src="<?=path?>/js/assets/owl.carousel.min.js"></script>
<script src="<?=path?>/js/assets/jquery.livequery.js"></script>
<script src="<?=path?>/js/assets/jquery.noty.packaged.js"></script>
<script src="<?=path?>/js/search.js"></script>
<script src="<?=path?>/js/assets/jquery.jscroll.min.js"></script>
<script src="<?=path?>/js/jquery.scrollbar.js"></script>


<script src="<?=path?>/js/Chart.min.js"></script>
<script src="<?=path?>/js/html2pdf.bundle.min.js"></script>

<script>
	var path    = '<?=path?>';
	var actions = '<?=(us_level ? 1 : 0)?>';
	var lang    = <?=json_encode($lang)?>;
</script>

<?php if(in_array(page, ['ask', 'details'])): ?>
<script src="<?=path?>/js/assets/file_upload/fileinput.min.js"></script>
<?php if($lang['lang'] == 'tr'): ?>
<script src="<?=path?>/js/assets/file_upload/locales/tr.js"></script>
<?php endif; ?>
<?php if($lang['lang'] == 'ar'): ?>
<script src="<?=path?>/js/assets/file_upload/locales/ar.js"></script>
<?php endif; ?>
<?php endif; ?>

<script src="<?=path?>/js/custom.js"></script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-97452740-1', 'auto');
  ga('send', 'pageview');

</script>
