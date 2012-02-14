$(window).load(function(){		
	initCufon();	
	initCarousel();
	initPopup();
	initScroll();
});


 function initCarousel(){
$("#content div.slader").jCarouselLite({
    btnNext: "#content div.slader span.next",
    btnPrev: "#content div.slader span.prev",
    speed: 400,
	visible: 4,
	circular: false
});
}

function initCufon(){
	Cufon.replace('#conteiner div.slogan p', {fontFamily: 'Myriad Pro Italic', hover: true});
	Cufon.replace('#conteiner div.slogan b', {fontFamily: 'Myriad Pro Bold', hover: true});
	Cufon.replace('#content div.top span,#popap div.form div.itemline span,div.blocker div.form div.itemline button,#content div.menu ul li a,#content div.body-bg div.item button span,h5,#content div.body-bg div.load a', {fontFamily: 'Myriad Pro Cond', hover: true});
	Cufon.replace('#content div.top h2', {fontFamily: 'Myriad Pro CondBold', textShadow:'#8f0b21 0 1px', hover: true});
	Cufon.replace('#content ul.serc li a.button-1,#content ul.serc li a.button-2,#content ul.serc li a.button-3', {fontFamily: 'Myriad Pro Cond', textShadow:'#8f0b21 0 1px', hover: true});
	Cufon.replace('h3,#content div.boxer ul.interest li a', {fontFamily: 'Myriad Pro CondBold', hover: true});
	Cufon.replace('div.optionsDivVisible li', {fontFamily: 'Myriad Pro Regular', hover: true});
}

function initPopup(){
	$('#popap-regist').hide();
	$('#shadow').css("opacity","0.8");
	$('#open').click(function(){
		$('#popap').fadeIn(500);
	});
	$('.close').click(function(){
		$('#popap').fadeOut(500);
	});
	$('#shadows').css("opacity","0.8");
	$('#opens').click(function(){
		$('#popap-regist').fadeIn(500);
	});
	$('.close').click(function(){
		$('#popap-regist').fadeOut(500);
	});
}

 function initScroll(){
	jQuery('.scroll').jScrollPane({scrollbarWidth:8, dragMaxHeight:32, showArrows:false});

}