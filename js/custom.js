( function ( $ ) {


/**
 * * 1) Functions
 * * 2) Header
 * * 3) File Upload
 * * 4) Sidebar
 * * 5) Members
 * * 6) Voting
 * * 7) Questions
 * * 8) ASK
 * * 9) Comments
 * * 10) Notifications
 */


/*
#-------------------------------------------------------------------------
# + 1) Functions
#-------------------------------------------------------------------------
*/

$.puerto_droped = function( prtclick, prtlist = "ul.dropdown" ){
	$(prtclick).livequery('click', function(){
		var ul = $(this).parent();
		if( ul.find(prtlist).hasClass('open') ){
			ul.find(prtlist).removeClass('open');
			$(this).removeClass('active');
			if(prtclick == ".pl-mobile-menu") $('body').removeClass('active');
		} else {
			ul.find(prtlist).addClass('open');
			$(this).addClass('active');
			if(prtclick == ".pl-mobile-menu") $('body').addClass('active');
		}
		return false;
	});
	$("html, body").livequery('click', function(){
		$(prtclick).parent().find(prtlist).removeClass('open');
		$(prtclick).removeClass('active');
		if(prtclick == ".pl-mobile-menu") $('body').removeClass('active');
	});
}

$.puerto_send = function ( prtform, prtrequest, prtreferer = false ){
	$(prtform).livequery('submit', function(){
		$this = $(this);
		$btn  = $this.find('button[type=submit]');
		$btxt = $btn.html();

		$btn.prop('disabled', true).html('<i class="fas fa-spinner fa-pulse fa-fw"></i> '+lang['loading']);

		$.post(path+'/ajax.php?request='+ prtrequest, $this.serialize(), function(puerto){
			$this.find('hr').before($(puerto.alert).hide().fadeIn());
			setTimeout(function(){ $this.find('.alert').fadeOut(function(){ $(this).remove(); }); }, 4000);
			if(puerto.type == 'success') {
				if( prtrequest == "send-comment" ){
					setTimeout(function(){
						$btn.html($btxt).prop('disabled', false);
						$this.parent().parent().find(".pl-comment-form").before(puerto.html);
						$this.parent().parent().find("textarea").val("");
						var $count = $this.parent().parent().parent().find(".pl-show-replies b");
						$count.text(parseInt($count.text())+1);
					}, 1000);
				} else if( prtrequest == "send-vote-answer"){
					setTimeout(function(){
						$('#myVoteModal').modal('hide');
						var inpVal = $('body').find('[name="pl-vote-inp[]"][value="'+puerto.id+'"]');
						var $count = inpVal.parent().parent().parent().parent().parent().find('.pl-show-votes b');
						inpVal.parent().parent().addClass('pl-answers-checked');
						inpVal.parent().addClass('pl-checked');
						$count.text(parseInt($count.text())+1);

						if(inpVal.parent().hasClass('pl-bool') || inpVal.parent().hasClass('pl-pics')){
							inpVal.parent().parent().parent().find('input').prop('disabled', true);
						} else {
							inpVal.parent().parent().find('input').prop('disabled', true);
						}
						$.each(puerto.percentage, function(key, val){
							$("label[for="+key+"]").append('<small class="timer timer-'+key+'" data-count="'+val+'">'+val+'</small>');
							$.puerto_timer('timer-'+key);
						});
					}, 4000);
				} else if( prtrequest == "subscribe"){
					$.puerto_alert('success', puerto.alert);
					setTimeout(function(){ $btn.html($btxt).prop('disabled', false); }, 4000);
				} else {
					setTimeout(function(){
						if(!prtreferer) location.reload();
						else $(location).attr('href', path+'/'+prtreferer);
					}, 4000);
				}
			} else {
				if(prtrequest == 'send-question'){
					setTimeout(function(){ $btn.html('Submit <i class="fas fa-arrow-circle-right"></i>').prop('disabled', false); }, 4000);
				} else if( prtrequest == "subscribe"){
					$.puerto_alert('error', puerto.alert);
					setTimeout(function(){ $btn.html($btxt).prop('disabled', false); }, 4000);
				} else {
					setTimeout(function(){ $btn.html($btxt).prop('disabled', false); }, 4000);
				}

			}
			console.log(puerto);
		}, 'json');
		return false;
	});
}

$.puerto_timer = function ( counterId ){
	$('.'+counterId).each(function() {
	  var $this = $(this),
	      countTo = $this.attr('data-count');

	  $({ countNum: $this.text()}).animate({
	    countNum: countTo
	  },
		{
	    duration: 2000,
	    easing:'linear',
	    step: function() {
	      $this.text(Math.floor(this.countNum)+'%');
	    },
	    complete: function() {
	      $this.text(this.countNum+'%');
	    }
	  });
	});
};

$.puerto_alert = function (type, text) {
  var n = noty({
      text        : text,
      type        : type,
      dismissQueue: true,
      theme       : false,
      closeWith   : ['button', 'click'],
      maxVisible  : 20,
			timeout     : 4000,
      animation   : {
        open  : 'animated bounceInRight',
        close : 'animated bounceOutRight',
        easing: 'swing',
        speed : 200
			}
  });
}

$.list_action_rp = function (ths, clss, id, fi, txt = false){
	return ths.replaceWith('<a href="javascript: void(0)" class="'+clss+'" rel="'+id+'"><i class="'+fi+'"></i>'+txt+'</a>');
}

$.list_action = function (listID, unlistID, listURL, listCOUNT = false, plus = true){
	$('.'+listID).livequery("click", function(){
		if(actions == "1"){
			var id     = $(this).attr("rel");
			var multi  = $(this).attr("data-multi");
			var $ths   = $(this);
			var $text  = $ths.text();
			var $html  = $ths.html();
			var $count = (listCOUNT) ? $ths.parent().parent().parent().parent().find('.'+listCOUNT) : '';
			var multi_ids = [];

			$ths.html('<i class="fas fa-spinner fa-pulse fa-fw"></i> '+lang['loading'])
					.css('cursor', 'not-allowed')
					.removeClass(listID);

			if(multi == 'true'){
				if($('[name="pl-check[]"]:checked').length){
					$('[name="pl-check[]"]:checked').each(function(){
						multi_ids.push($(this).val());
					});
					console.log(multi_ids);
				}
			}

			$.post(path+"/ajax.php?request="+listURL, { id : id, multi: multi, multi_ids: multi_ids }, function(data){
				if( data.type == 'success' ){
					if(data.alert)
						$.puerto_alert('success', data.alert);

					setTimeout(function(){

						switch(listURL){
							case 'actions&type=members-admin':
								$.list_action_rp($ths, unlistID, id, "icons icon-user", " as user");
							break;
							case 'actions&type=members-user':
								$.list_action_rp($ths, unlistID, id, "icons icon-badge", " as admin");
							break;
							case 'actions&type=members-verified':
								$.list_action_rp($ths, unlistID, id, "fas fa-times", " Unverified account");
								$('#pt-obj-'+id).find('.pl-thumb').after('<i class="icon-check icons pl-verified" title="Verified acount"></i>');
							break;
							case 'actions&type=members-unverified':
								$.list_action_rp($ths, unlistID, id, "fas fa-check", " Verified account");
								$('#pt-obj-'+id).find('.pl-verified').remove();
							break;
							case 'actions&type=members-ban':
								$.list_action_rp($ths, unlistID, id, "fas fa-check-circle", " Unban user");
								$('#pt-obj-'+id).addClass('bg-banned');
							break;
							case 'actions&type=members-unban':
								$.list_action_rp($ths, unlistID, id, "fas fa-ban", " Ban user");
								$('#pt-obj-'+id).removeClass('bg-banned');
							break;
							case 'member-trash':
								$('#pt-obj-'+id).remove();
							break;
							case 'category-trash':
								if(multi == 'true'){
									$ths.html('<i class="fas fa-trash"></i> Trash')
											.attr('style', '')
											.addClass(listID);

									$('[name="pl-check[]"]:checked').each(function(){
										$(this).prop('checked', false);
										$('#pt-obj-'+$(this).val()).remove();
									});
								} else {
									$('#pt-obj-'+id).remove();
								}
							break;
							case 'actions&type=member-follow':
							case 'actions&type=member-unfollow':

								var $unlistID = unlistID;
								if($ths.hasClass('pl-sidebar-fl')){
									$unlistID =  unlistID+' pl-buttons bg-'+(plus?'9':'0')+' pl-sidebar-fl';
								} else if($ths.hasClass('pl-profile-fl')) {
									$unlistID =  unlistID+' pl-buttons bg-'+(plus?'9':'1')+' pl-profile-fl';
									if($count)
										$count = $('.'+listCOUNT);
								}

								$.list_action_rp($ths, $unlistID, id, 'icon-user-'+(plus?'un':'')+'follow icons', (plus?lang['members']['unfollow']:lang['members']['follow']));

							break;
							case 'actions&type=question-follow':
							case 'actions&type=question-unfollow':
								$.list_action_rp($ths, unlistID, id, 'icon-user-'+(plus?'un':'')+'follow icons', (plus?lang['questions']['unfollow']:lang['questions']['follow']));
							break;
							case 'actions&type=question-trash':
								$ths.parent().parent().parent().parent().parent().parent().remove();
							break;
							case 'actions&type=read-all-noty':
								$ths.html($html).attr('style', '').addClass(listID);
								$('.pl-notifications li.bg-unread').each(function(){
									$(this).removeClass('bg-unread');
								});
							break;
							case 'actions&type=questions-reject':
							case 'actions&type=members-reject':
							case 'actions&type=comments-reject':
								if(multi == 'true'){
									$ths.html($html).attr('style', '').addClass(listID);

									$('[name="pl-check[]"]:checked').each(function(){
										$(this).prop('checked', false);
										$('#pt-obj-'+$(this).val()).addClass('bg-banned')
									});
								} else {
									$('#pt-obj-'+id).addClass('bg-banned')
								}
							break;
							case 'actions&type=questions-approve':
							case 'actions&type=members-approve':
							case 'actions&type=comments-approve':
								if(multi == 'true'){
									$ths.html($html).attr('style', '').addClass(listID);

									$('[name="pl-check[]"]:checked').each(function(){
										$(this).prop('checked', false);
										$('#pt-obj-'+$(this).val()).removeClass('bg-banned')
									});
								} else {
									$('#pt-obj-'+id).removeClass('bg-banned')
								}
							break;
							case 'actions&type=category-trash':
							case 'actions&type=page-trash':
							case 'actions&type=questions-trash':
							case 'actions&type=members-trash':
							case 'actions&type=comments-trash':
							case 'actions&type=subscribers-trash':
							case 'actions&type=lang-trash':
								if(multi == 'true'){
									$ths.html($html).attr('style', '').addClass(listID);

									$('[name="pl-check[]"]:checked').each(function(){
										$(this).prop('checked', false);
										$('#pt-obj-'+$(this).val()).remove();
									});
								} else {
									$('#pt-obj-'+id).remove();
								}
							break;
							default:
						}

						if($count){
							if(listURL=='actions&type=read-all-noty'){
								$count.text(parseInt(0));
							} else {
								if(plus){
									$count.text(parseInt($count.text())+1);
								} else {
									$count.text(parseInt($count.text())-1);
								}
							}
						}
					}, 1000);
				} else {
					$.puerto_alert('error', data.alert);
					setTimeout(function(){
						$ths.html($html).attr('style', '').addClass(listID);
				 	}, 1000);
				}
			}, 'json');
		} else {
			$("#sign-modal").modal('show');
		}
	});
}

$(".pt-plan form").on("submit",function(){
	if(actions == 0){
		$("#sign-modal").modal('show');
		return false;
	}
	else {
		return $(this).submit();
	}
});


/*
#-------------------------------------------------------------------------
# + 2) Header
#-------------------------------------------------------------------------
*/

/** Search **/
if($(".search").length){
	$(document).ready(function(){
		$("input.search").blur();
	});
	$('.search').searchbox({
	  url   : path+"/ajax.php?request=search",
	  dom_id: '.pl-search-result',
	  delay : 250
	});
}
if($(".pt-scroll").length){
	$('.pt-scroll').scrollbar();
}

/** Notifications **/
$.puerto_droped( ".pl-notifications-show" );

/** Categories **/
$.puerto_droped( ".cats-links" );

/** User Details **/
$.puerto_droped( ".show-user-details" );

/** User Details **/
$.puerto_droped( ".pl-mobile-menu", ".pl-menu" );

/** Lang **/
$.puerto_droped( ".pt-show-lang" );

/** Forget Modal **/
$('.forget-modal').livequery('click', function(){
	$('#sign-modal').modal('hide');
	$('#forget-modal').modal('show');
});

/** Logout **/
$('.logout').livequery('click', function(){
	if(confirm(lang['header']['confirm'])){
		$.post(path+"/ajax.php?request=logout", {type: 1}, function(puerto){
			$(location).attr('href', path+'/index.php');
		});
	}
});


/** Sign In **/
$.puerto_send( "#sign-modal form", "login" );

/** Forget Passwrod **/
$.puerto_send( "#forget-modal form", "password-forget" );

/** Reset Passwrod **/
$.puerto_send( "#password-reset", "password-reset", "index.php" );

/** Subscribe **/
$.puerto_send( "#subscribe", "subscribe" );

/** Sign Up **/
$.puerto_send( "#pl-signup form", "register", "index.php" );

/** Send Password **/
$.puerto_send( "#password-modal form", "send-password" );

/** Send Password **/
$.puerto_send( "#send-credits", "send-credits" );

/** Language Change **/
$('.pl-lang a').livequery("click", function(){
	var $th = $(this);
	var $id = $th.attr('rel');
	var $ht = $th.html();
	$th.html('<i class="fas fa-spinner fa-pulse fa-fw"></i>');

	$.post(path+"/ajax.php?request=lang", { id : $id }, function(data){
		$th.html($ht);
		location.reload();
	}, 'json');
	return false;
});


/*
#-------------------------------------------------------------------------
# + 3) File Upload
#-------------------------------------------------------------------------
*/

/** File Upload **/
if($("#images").length){
$("#images").fileinput({
		language: lang['lang'],
    uploadAsync: false,
		showZoom: false,
    uploadUrl: path+"/ajax.php?request=upload",
		allowedFileExtensions: ["jpg", "jpeg", "bmp", "png", "gif"],
		actionZoom: false
});

$('#images').on('fileuploaded', function(event, data) {
    console.log(event);
    console.log(data);
});

$('#images').on('filebatchuploadsuccess', function(event, data, previewId, index) {
		console.log(data.response);

		var dataUploaded = data.response.file_output;
		var i;
		for(i=0;i<dataUploaded.length;i++){
			if(dataUploaded[i].success === true){
				$('.pl-select-append').append('<option value="'+dataUploaded[i].path+'">'+dataUploaded[i].name+'</option>');
				$('.pl-select-append').prop('disabled', false).removeClass('disabled');
			}
		}
});
}


/*
#-------------------------------------------------------------------------
# + 4) Sidebar
#-------------------------------------------------------------------------
*/


/** Questions **/
$.puerto_droped( ".questions-filter-link" );

$('.pl-sidebar-questions').livequery('click', function(){
	var $ths = $(this);
	var $type = '';
	var $typeHTML = '';
	if($ths.hasClass('month')){
		$type = 'month';
		$typeHTML = lang['sidebar']['questions']['month'];
	} else if($ths.hasClass('year')){
		$type = 'year';
		$typeHTML = lang['sidebar']['questions']['year'];
	} else if($ths.hasClass('day')){
		$type = 'day';
		$typeHTML = lang['sidebar']['questions']['day'];
	}
	$('.pl-sidebar .pl-polls').append('<div class="pl-overlay"><div class="pl-dtable"><div class="pl-vmiddle text-center"><i class="fas fa-spinner fa-pulse fa-fw"></i> '+lang['loading']+'</div></div></div>');
	$.get(path+"/ajax.php?request=sidebar-questions&type="+$type, function(data){
		setTimeout(function(){
			$('.questions-filter-link').html(''+$typeHTML+'');
			$('.pl-sidebar .pl-polls').html(data);
		}, 1000);
	});
	return false;
});

/** Users should follow **/
if($(".owl-carousel").length){
$('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    items: 1,
    navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>']
});
}


/*
#-------------------------------------------------------------------------
# + 5) Members
#-------------------------------------------------------------------------
*/

$.list_action('pl-user-follow-list', 'pl-user-unfollow-list', 'actions&type=member-follow', 'pl-show-followers');
$.list_action('pl-user-unfollow-list', 'pl-user-follow-list', 'actions&type=member-unfollow', 'pl-show-followers', false);

/** Profile options **/
$.puerto_droped('.pl-user-options');

/** Details **/
$.puerto_send( "#send-details", "send-details" );

/** Small Desc: Letters Count  **/
$('.pl-small-desk small').html(50 + ' letter left');

/** Small Desc: Letters Keyup Count  **/
$('.pl-small-desk textarea').keyup(function() {
	var text_length = $(this).val().length;
	var text_remaining = 50 - text_length;
	if( text_length <= 50 )
		$('.pl-small-desk small').html(text_remaining + ' letter left');
	else
		$('.pl-small-desk small').html('<span class="red">' + text_remaining + ' more than you need</span>');
});

if($(".datepicker").length){
$('#datepicker').datepicker();
}


/*
#-------------------------------------------------------------------------
# + Voting
#-------------------------------------------------------------------------
*/

/** Vote Label Click **/
$('[name="pl-vote-inp[]"]').livequery('click', function(){
	var $this = $(this);
	var $count = $this.parent().parent().parent().parent().parent().find('.pl-show-votes b');
	var $iframed = $this.parent().parent();
	var $as_iframed = 0;

    if($iframed.hasClass('pl-iframed'))
        $as_iframed = 1;

	$.post(path+'/ajax.php?request=send-vote', {id: $this.val(), iframed: $as_iframed}, function(puerto){
		if(puerto.type == "danger"){
			if(puerto.html === true){
				$("#pl-vote-fieldsmodal").html(puerto.alert);
				$('#myVoteModal').modal('show');
			} else {
				$.puerto_alert('error', puerto.alert);
			}
		} else {
			$.puerto_alert('success', puerto.alert);
			$this.parent().parent().addClass('pl-answers-checked');
			$this.parent().addClass('pl-checked');
			$count.text(parseInt($count.text())+1);
			if($this.attr('type') == "radio"){
				if($this.parent().hasClass('pl-bool') || $this.parent().hasClass('pl-pics')){
					$this.parent().parent().parent().find('input').prop('disabled', true);
				} else {
					$this.parent().parent().find('input').prop('disabled', true);
				}
			}
			$.each(puerto.percentage, function(key, val){
				$("label[for="+key+"]").append('<small class="timer timer-'+key+'" data-count="'+val+'">'+val+'</small>');
				$.puerto_timer('timer-'+key);
			});
		}

		console.log($iframed);
		console.log(puerto);
	}, 'json');
	return false;
});

$.puerto_send( "#myVoteModal form", "send-vote-answer" );

/*
#-------------------------------------------------------------------------
# + Questions
#-------------------------------------------------------------------------
*/

/** Question Share Button **/

$.puerto_droped('.pl-share-button');

function windowPopup(url, width, height) {
	var left = (screen.width / 2) - (width / 2),
			top  = (screen.height / 2) - (height / 2);
	window.open(url, "", "menubar=no,toolbar=no,resizable=yes,scrollbars=yes,width="+width+",height="+height+",top="+top+",left="+left);
}

$(".puerto-popup").on("click", function(e) {
	e.preventDefault();
	windowPopup($(this).attr("href"), 500, 300);
});

/** Question Follow Button **/

$(".pl-question-follow").livequery("click", function(){
	if(actions == 1){
		var id     = $(this).attr("rel");
		var $ths   = $(this);
		var $count = $ths.parent().parent().parent().parent().parent().find('.pl-show-tags b');

		$ths.html('<i class="fas fa-spinner fa-pulse fa-fw"></i>');

		$.post(path+"/ajax.php?request=actions&type=question-follow", { id : id }, function(data){
			if( data.type == 'success' ){
				setTimeout(function(){
						$ths.replaceWith('<a href="#" class="pl-question-unfollow pl-plus-buttons pl-notext" rel="'+id+'" title="'+lang['questions']['unfollow']+'"><i class="fas fa-star-half-o"></i></a>');
						$count.text(parseInt($count.text())+1);
				}, 1000);
			} else {
				setTimeout(function(){
						$ths.replaceWith('<a href="#" class="pl-question-follow pl-plus-buttons pl-notext" rel="'+id+'" title="'+lang['questions']['follow']+'"><i class="fas fa-star"></i></a>');
			 	}, 1000);
			}
		}, 'json');
	} else {
		$("#sign-modal").modal('show');
	}
	return false;
});

/** Question Unfollow Button **/

$(".pl-question-unfollow").livequery("click", function(){
	if(actions == 1){
		var id     = $(this).attr("rel");
		var $ths   = $(this);
		var $count = $ths.parent().parent().parent().parent().parent().find('.pl-show-tags b');

		$ths.html('<i class="fas fa-spinner fa-pulse fa-fw"></i>');

		$.post(path+"/ajax.php?request=actions&type=question-unfollow", { id : id }, function(data){
			if( data.type == 'success' ){
				setTimeout(function(){
						$ths.replaceWith('<a href="javascript: void(0)" class="pl-question-follow pl-plus-buttons pl-notext" rel="'+id+'" title="'+lang['questions']['follow']+'"><i class="fas fa-star"></i></a>');
						$count.text(parseInt($count.text())-1);
				}, 1000);
			} else {
				setTimeout(function(){
						$ths.replaceWith('<a href="javascript: void(0)" class="pl-question-unfollow pl-plus-buttons pl-notext" rel="'+id+'" title="'+lang['questions']['unfollow']+'"><i class="fas fa-star-half-o"></i></a>');
			 	}, 1000);
			}
		}, 'json');
	} else {
		$("#sign-modal").modal('show');
	}
	return false;
});


/** Embed Form **/
$('.pl-show-embed').livequery("click", function(){
	var $ths   = $(this);
	var $height = $ths.parent().parent().parent().parent().parent().parent().parent().parent();
	var $form = $ths.parent().parent().parent().parent().parent().parent().parent().find('.pt-embed-form');
    console.log($height.height());
    $form.find('pre').text(function(){
        return $(this).text().replace('315',($height.height()+23)).replace('460px','100%');
    });
	$form.show();
	return false;
});

$('.pl-hide-embed').livequery("click", function(){
	var $ths   = $(this);
	$ths.parent().hide();
	return false;
});


/** Question Follow Button (Send as List) **/
$.list_action('pl-question-follow-list', 'pl-question-unfollow-list', 'actions&type=question-follow', 'pl-show-tags');
$.list_action('pl-question-unfollow-list', 'pl-question-follow-list', 'actions&type=question-unfollow', 'pl-show-tags', false);

/** Question Trash **/
$.list_action('pl-question-trash', '', 'actions&type=question-trash', '');



/** Question Repports **/
$("[data-target='#report-modal']").livequery("click", function(){
	if(actions == 1){
		var id = $(this).attr("rel");
		$("[name=report_id]").val(id);
	} else {
		$("#sign-modal").modal('show');
	}
});

/** Question Repport Send **/
$.puerto_send( "#report-modal form", "send-report" );

/** Stats **/
$('.stats-download').livequery('click', function(){

	var title = $(this).data("name");
	var element = document.getElementById('root');


	// Choose pagebreak options based on mode.
	var mode = 'avoid-all';
	var pagebreak = (mode === 'specify') ?
			{ mode: '', before: '.before', after: '.after', avoid: '.avoid' } :
			{ mode: mode };

	// Generate the PDF.
	html2pdf().from(element).set({
		filename: title + '.pdf',
		margin: 1,
		pagebreak: 'legacy',
		jsPDF: {orientation: 'portrait', unit: 'in', format: 'letter', compressPDF: true}
	}).save();
	console.log("dd");

	return false;
});



//- Rapport Stats

$.barChart = function(ChartID, DataLabelss, DataCnts, DataClrs, DataTitle, DataType = 'bar'){
	new Chart(document.getElementById(ChartID), {
	    type: DataType, //horizontalBar
	    data: {
	      labels: DataLabelss,
	      datasets: [
	        {
	          label: DataTitle,
	          backgroundColor: DataClrs,
	          data: DataCnts
	        }
	      ]
	    },
	    options: {
	      legend: { display: false },
	      title: {
	        display: (DataTitle ? true : false),
	        text: DataTitle
	      },
				scales: {
	        xAxes: [{
            ticks: { beginAtZero: true }
	        }]
		    }
	    }
	});
}

$.lineChart = function(DataLabelss, DataCnts, DataTitle){
	new Chart(document.getElementById("line-chart"), {
		type: 'line',
		data: {
			labels: DataLabelss,
			datasets: [{
					data: DataCnts,
					label: false,
					borderColor: "#5f90fa",
					backgroundColor: 'rgba(95, 144, 250, 0.65)'
				}
			]
		},
		options: {
			legend: {
					display: false
			},
			title: {
				display: (DataTitle ? true : false),
				text: DataTitle
			},
			scales: {
					xAxes: [{
							ticks: {
									autoSkip: false,
									maxRotation: 40,
									minRotation: 40
							}
					}]
			}
	}
	});
}

$.pieChart = function(DataId, DataLabels, DataCnt, DataClrs, DataTitle){
	new Chart(document.getElementById(DataId), {
    type: 'doughnut',
    data: {
      labels: DataLabels,
      datasets: [
        {
          label: "Partisipate of",
          backgroundColor: DataClrs,
          data: DataCnt
        }
      ]
    },
		options: {
			legend: { display: true },
			title: {
				display: (DataTitle ? true : false),
				text: DataTitle
			}
		}
	});
}

if($("#question-gender").length){
$.get(path+"/ajax.php?request=question-gender&id="+$("#question-gender").attr('rel'), function(puerto) {

	var ass = JSON.parse(puerto);
	var DataLabelss = ass.labels;
	var DataCnts = ass.data;
	var DataTitle = ass.title;
	var DataClrs = ass.colors;

	$.barChart("question-gender", DataLabelss, DataCnts, DataClrs, DataTitle, 'horizontalBar');
	console.log(puerto);

});
}

if($("#question-age").length){
$.get(path+"/ajax.php?request=question-age&id="+$("#question-age").attr('rel'), function(puerto) {

	var ass = JSON.parse(puerto);
	var DataLabelss = ass.labels;
	var DataCnts = ass.data;
	var DataTitle = ass.title;
	var DataClrs = ass.colors;

	$.pieChart("question-age", DataLabelss, DataCnts, DataClrs)
	console.log(puerto);

});
}

/*
#-------------------------------------------------------------------------
# + Ask
#-------------------------------------------------------------------------
*/

/** Change answers by question type **/
$('[name=qs_type]').livequery('change',function(){
	var val = $(this).val();
	if(val == 1){
		$('#poll-type-append').html('<p></p><label class="pl-answer-label">'+
				''+lang['ask']['type']['answers']+' <small class="pl-add-answer">('+lang['ask']['type']['add']+')</small> <b class="red">*</b>'+
				'<input type="text" name="qs_answers[]" placeholder="'+lang['ask']['type']['place']+'">'+
				'<input type="text" name="qs_answers[]" placeholder="'+lang['ask']['type']['place']+'">'+
		'</label>');
	} else if(val == 2) {
		$('#poll-type-append').html('');
	} else {
		$('#poll-type-append').html('<p></p>'+
				'<div class="pl-row">'+
					'<div class="pl-col-8">'+
						'<label class="pl-answer-label">'+
							''+lang['ask']['type']['answers']+' <small class="pl-add-answer-image">('+lang['ask']['type']['add']+')</small> <b class="red">*</b>'+
							'<input type="text" name="qs_answers[]" placeholder="'+lang['ask']['type']['place']+'">'+
						'</label>'+
					'</div>'+
					'<div class="pl-col-4">'+
						'<label class="pl-answer-label">'+
							''+lang['ask']['type']['images']['place']+' <b class="red">*</b>'+
							'<div class="pl-select">'+
								'<select name="qs_answers_images[]"'+($('[name=qs_thumb]').hasClass('disabled')?' class="disabled pl-select-append" disabled':'')+'>'+
									$('[name=qs_thumb]').html()+
								'</select>'+
							'</div>'+
						'</label>'+
					'</div>'+
				'</div>');
	}
})

/** Add New answer field **/
$(".pl-add-answer").livequery('click', function(){
	if( $('input[name="qs_answers[]"]').length < 8 ){
		$("#poll-type-append").append('<div class="pl-answer-inp"><input type="text" name="qs_answers[]" placeholder="'+lang['ask']['type']['place']+'"><a class="pl-buttons pl-icon bg-8 pl-close-inp"><i class="fas fa-times"></i></a></div>');
	}
});

$(".pl-close-inp").livequery('click', function(){
	if(confirm('Are you sure you want to take this action?'))
		$(this).parent().remove();
});

/** Add New answer field with image **/
$(".pl-add-answer-image").livequery('click', function(){
	if( $('input[name="qs_answers[]"]').length < 9 ){
		$("#poll-type-append").append('<div class="pl-answer-inp">'+
				'<div class="pl-row">'+
					'<div class="pl-col-8">'+
						'<label class="pl-answer-label pl-answer-inp">'+
							'<input type="text" name="qs_answers[]" placeholder="'+lang['ask']['type']['place']+'">'+
							'<a class="pl-buttons pl-icon bg-8 pl-close-inpImg"><i class="fas fa-times"></i></a>'+
						'</label>'+
					'</div>'+
					'<div class="pl-col-4">'+
						'<label class="pl-answer-label">'+
							'<div class="pl-select">'+
								'<select name="qs_answers_images[]"'+($('[name=qs_thumb]').hasClass('disabled')?' class="disabled" disabled':'')+'>'+
									$('[name=qs_thumb]').html()+
								'</select>'+
							'</div>'+
						'</label>'+
					'</div>'+
				'</div>'+
			'</div>');
	}
});

$(".pl-close-inpImg").livequery('click', function(){
	if(confirm('Are you sure you want to take this action?'))
		$(this).parent().parent().parent().parent().remove();
});

$("[name=qs_multiple]").on("change", function(){
	if($(this).is(":checked")){
		$("#qs_type_2").prop("disabled", true);
	} else {
		$("#qs_type_2").prop("disabled", false);
	}
});

/** Send **/
$.puerto_send( "#send-question", "send-question", "index.php" );

/*
#-------------------------------------------------------------------------
# + Comments
#-------------------------------------------------------------------------
*/

/** View More Comments **/

$(".pl-more a").livequery("click", function(){
	var id           = $(this).attr("id").replace("pl-more-","");
	var poll_id      = $(this).attr("rel");
	var com_id       = $(this).parent().find("small");
	var inst_comment = $(this).parent().parent().find(".instant_comment");
	var $ths         = $(this);
	var my_arr       = [];

	$ths.html('<i class="fas fa-spinner fa-pulse fa-fw"></i> '+lang['loading']);

	inst_comment.each(function(i,obj){
		my_arr.push($(this).attr("id").replace("c"+poll_id,""));
	});

	$.post(path+"/ajax.php?request=more-comments", { last_id : id, poll_id : poll_id, com_id : com_id.text(), push_arr : my_arr }, function(data){
		if( data.type == 'success' ){
			setTimeout(function(){
					$ths.parent().after(data.html);
					$ths.parent().html(data.url);
		 	}, 1000);

		} else {
			$ths.parent().hide();
		}
	}, 'json');
	return false;
});

/** Comment form Toggle **/

$(".pl-write-comment textarea").livequery("click", function(){
	$(this).parent().parent().addClass('pl-active');
	return false;
});

$(".pl-write-comment .cancel").livequery("click", function(){
	$(this).parent().parent().removeClass('pl-active');
	return false;
});

/** Send Comment **/
$.puerto_send( ".pl-comment-form form", "send-comment" );


/*
#-------------------------------------------------------------------------
# + Notifications
#-------------------------------------------------------------------------
*/


$('.pl-notifications ul').livequery('click', function(e){
	e.preventDefault();
	return false;
});

$('.pl-notifications li').livequery('click', function(e){
	var th = $(this);
	var id = $(this).data('notid');
	var url = $(this).data('noturl');
	var txt = $('.pl-notifications-show small');
	$.post(path+'/ajax.php?request=actions&type=notification-read', { id: id }, function(data){
		if(data.type == 'success'){
			th.removeClass('bg-unread');
			txt.text(parseInt(txt.text())-1);
		}

	   $(location).attr('href', url);

	}, 'json');

	return false;
});

$.list_action('pl-read-all-noty', '', 'actions&type=read-all-noty', 'pl-notifications-show small');

if($('.jscroll').length){
$('.jscroll').jscroll({
    loadingHtml: '<span class="pl-more"><i class="fas fa-spinner fa-pulse fa-fw"></i> '+lang['loading']+'</span>',
    padding: 20,
    nextSelector: 'a.jscroll-next:last',
    contentSelector: 'li'
});
}







$(document).ready(function(){
$(function () {
/* map parameters */
var wrld = {
    map: 'world_mill_en',
    normalizeFunction: 'polynomial',
    regionStyle: regionStyling,
    backgroundColor: "transparent",
		zoomOnScroll: false,
    series: {
      regions: [{
        values: return_first,
        attribute: 'fill',
        scale: ['#fd8082', '#f43438']}
    ]},
  onRegionTipShow: function(e, el, code){
    el.html( return_first[code] + ' Votes from ' + el.html());
    $(".lbl-hover").html('Hovered country value: ' + return_first[code]);
  }
};

/* Setting up of the map */
if ($('#world-map').length > 0) {
    $('#world-map').vectorMap(wrld);
}

}); // End - (function(---))
}) // End - $(document).ready...
/* Basic styling for the map */
var regionStyling = { initial: { fill: '#5c6366' }, hover: { fill: '#B0013A' }, selected: { fill: '#B0013A' } };

var return_first = function () {
  var tmp = null;
  $.ajax({
    'async': false,
    'type': "GET",
    'dataType': 'JSON',
    'url': path+'/ajax.php?request=world',
    'success': function (data) {
        tmp = data;
    }
  });
  return tmp;
}();


} ( jQuery ) )
