(function($){
	$(function(){
		// resent templates description animation
		$('#nav>li>a').hover(
			function(){
				$(this).stop(1);
				$(this).animate({'background-position':'0px 0'});
			},
			function(){
				$(this).stop(1);
				$(this).animate({'background-position':'-140px 0'});
			}
		)
		
		$('.boxgrid').each(function(){
			var $caption = $(this).find('span.boxcaption');
			var pheight = $(this).height();
			$caption.css('top', pheight );
			
			$(this).hover(
				function(){
					$caption.stop(1);
					$caption.animate({ top: pheight - $caption.height() });
				},
				function(){
					$caption.stop(1);
					$caption.animate({ top: pheight	})
				}
			)
		});
		
		
		function showHideHead(show){
			if (show) {
				$('#headerdemo').show();
				$('#work-list').show();
			}
			else {
				$('#headerdemo').hide();
				$('#work-list').hide();
			}
		}
		
		// responsive animation
		if ($('input.respond').length){
			$('.container').css('max-width','1000px');
			
			$('.respond label').click(function(){
				var for_attr = $(this).attr('for');
				if (for_attr=="respond_desktop"){
					showHideHead(1);
					$('.container').animate({'max-width':'1000px'},400);
				}
				else if (for_attr=="respond_ipad"){
					$('.container').animate({'max-width':'800px'},400);
					showHideHead(1);
				}
				else if (for_attr=="respond_iphone"){
					$('.container').animate({'max-width':'480px'},400);
					showHideHead(0);
				}
			})
		}
		
		// init mails
		var imgs = document.getElementsByTagName('img');
		var mq = /\?mquery=([^\.]+)\.(.+)/,a;
		for (var i=0; i<imgs.length; i++)
			if (a = mq.exec(imgs[i].src))
				$(imgs[i]).wrap('<a href="mai'+'lto:'+a[1]+'@'+a[2]+'.com">');
	});
})(jQuery);