$(document).ready(function () {

	$('input[type="text"]').val("");
	/* общие действия форм */
	$('input[type="text"]').focus(function (){
		var input_id =$(this).attr('id');
		$('label[for="'+input_id+'"]').hide();
	});

	$('input[type="text"]').blur(function() {
		if ($(this).val()=="")
		{
			var input_id =$(this).attr('id');
			$('label[for="'+input_id+'"]').show();
		}
	});
	/***********************/
	/* Позиционирование окна по центру экрана */
	function pos (elem)
	{
		var page_h = $(window).height();
		var page_w = $(window).width();
		var el_h=elem.outerWidth();
		var el_w=elem.outerWidth();
		var t=(page_h/2)-(el_h/2);
		var l=(page_w/2)-(el_w/2);
		elem.css({'left': l+'px','top':t+'px'});
	}

	/* очиска полей форм */
	function f_clr()
	{
		$('input[type="text"]').removeClass('err');
		$('input[type="text"]').val("");
		$('label').show();
		$('#popup_bg').fadeOut(1000);
		$('#popup').fadeOut(1000);
	}
	/************************/
	/************ отправка писем ajax ****************/
	function send_ajax (txt)
	{
		var req_crm = new XMLHttpRequest();
		req_crm.open("POST", "/tpl/rest.php", true);
		req_crm.send(txt);

		var req = new XMLHttpRequest();
		req.open("POST", "/tpl/send.php", true);
		req.send(txt);
		$("#popup").fadeOut(300);
		req.onreadystatechange = function()
		{
			if (req.readyState != 4) return;
			send_ok(req.responseText);

		}
	}

	/* ответ сервера */
	function send_ok (otvet)
	{
		if (otvet==true)
		{
			pos ($("#otvet_s"))
			$('#otvet_s').fadeIn(300);
		}

	}
	/******************************/

	/* Закрытие POPUP */
	$("#popup_bg, .close").click(function(){
		$("#popup").fadeOut(300);
		$("#otvet_s").fadeOut(300);
		$("#popup_bg").fadeOut(300);
		$('input').removeClass('err');
		f_clr();
	});
	/*******************/




	/* убираем ошибку при фокусе */
	$('input[type="text"]').focus(function(){
		if ($(this).attr("class")=="err")
		{
			$(this).removeClass("err");
		}
	});
	/********************** Плавный скрол к якарям ***************/
	$('#header ul.nav li a, a.b_nav').click(function (ev) {
		ev.preventDefault();
		elementClick = $(this).attr("href");
		destination = $(elementClick).offset().top;
		if($.browser.safari || $.browser.webkit){
			$('body').animate( { scrollTop: destination }, 1100 );
		}else{
			$('html').animate( { scrollTop: destination }, 1100 );
		}
		/******************** Клики по кнопке контактов ***************/
		if ($(this).hasClass("contacts"))
		{
			$('#b2_elem_wrap .b2_elem.current').removeClass("current");
			$('#b2_elem_wrap .b2_elem[data-elem="4"]').addClass("current");
			$('#b2_2 div.elem.current').removeClass("current");
			$('#b2_2 div.elem[data-elem="4"]').addClass("current");
		}
		/**************************************************************/
	});
	/**************************************************************/

	/******************** Клики по вкладкам блока *****************/
	$('#b2_elem_wrap div.b2_elem').click(function () {
		if (!$(this).hasClass("current"))
		{
			var id_elem = $(this).attr("data-elem");


			$('#b2_elem_wrap .b2_elem.current').removeClass("current");
			$(this).addClass("current");

			$('#b2_2 div.elem.current').removeClass("current");
			$('#b2_2 div.elem[data-elem="'+id_elem+'"]').addClass("current");
		}
	});

	$('#b2_2 a.next').click(function (ev) {
		ev.preventDefault();
		$('#b2_elem_wrap .b2_elem.current').removeClass("current");
		$('#b2_elem_wrap .b2_elem[data-elem="2"]').addClass("current");
		$('#b2_2 div.elem.current').removeClass("current");
		$('#b2_2 div.elem[data-elem="2"]').addClass("current");

	});
	/**************************************************************/

	/**************************************************************************/
	/************************ Калькулятор онлайн расчета **********************/
	/******************************** Чекбоксы ********************************/
	$('#calc_wrap li').click(function(){
		var num_cb = $(this).parents("ul").attr("data-calc");
		if ($('#calc_wrap ul[data-calc="'+num_cb+'"]').hasClass("o_v"))
		{
			if(!$(this).hasClass("select"))
			{
				$('#calc_wrap ul[data-calc="'+num_cb+'"] li.select').removeClass("select");
				$(this).addClass("select");
			}
		}
		else if($('#calc_wrap ul[data-calc="'+num_cb+'"]').hasClass("m_v"))
		{
			if ($(this).hasClass("select"))
			{
				$(this).removeClass("select");
			}
			else
			{
				$(this).addClass("select");
			}
		}
	});
	/************************** Переход между шагами **************************/
	var last_step = 4;
	$("#calc_next").click(function(e){
		e.preventDefault();
		var step = $('#calc_wrap div.active').attr("data-step");
		var next_step = parseInt(step)+1;
		$('#calc_wrap div.active').removeClass("active");
		$('#calc_wrap div[data-step="'+next_step+'"]').addClass("active");
		$('#calc_prew').css("display","flex");
		if (next_step==last_step)
		{
			$(this).css("display","none");
			$("#calc_b").css("display","flex");
		}

	});
	$("#calc_prew").click(function(e){
		e.preventDefault();
		var step = $('#calc_wrap div.active').attr("data-step");
		var prew_step = parseInt(step)-1;
		$('#calc_wrap div.active').removeClass("active");
		$('#calc_wrap div[data-step="'+prew_step+'"]').addClass("active");
		$('#calc_next').css("display","flex");
		$("#calc_b").css("display","none");
		if (prew_step==1)
		{
			$(this).css("display","none");
		}
	});
	/**************************************************************************/

	/* POPUP Запись на замер*/
	$("#zamer").click(function(e){
		e.preventDefault();
		$("#popup h3").html("Записаться<br>на замер<br>к профессионалам");
		$("#popup button").html("Записаться");
		$('#popup form input[name="tema"]').val("Запись на замер");
		$('#popup input[name="dob"]').val("Блок первый шаг");

		$("#popup_bg").fadeIn(300);
		$("#popup").fadeIn(300);
		pos($("#popup"));
	});
	/******************/

	/* POPUP Запись на консультацию*/
	$("#cons").click(function(e){
		e.preventDefault();
		$("#popup h3").html("Записаться на<br>консультацию");
		$("#popup button").html("Записаться");
		$('#popup form input[name="tema"]').val("Запись на консультацию");
		$('#popup input[name="dob"]').val("Блок 4 контакты");

		$("#popup_bg").fadeIn(300);
		$("#popup").fadeIn(300);
		pos($("#popup"));
	});
	/******************/

	/* POPUP Каклькулятор */
	$("#calc_b").click(function(e){
		e.preventDefault();
		$("#popup h3").html("Хочу узнать<br/>стоимость кухни");
		$("#popup button").html("Узнать");
		$('#popup form input[name="tema"]').val("Стоимость кухни");
		/* Данные с калькулятора */
		var rez_calc = "";
		rez_calc+="<b>Тип кухни:</b> "+$('#calc_wrap ul[data-calc="1"] li.select').html();
		rez_calc+="<br/><b>Размер:</b> "+$('#calc_wrap input[name="size"]').val();
		rez_calc+="<br/><b>Материал:</b> "+$('#calc_wrap ul[data-calc="3"] li.select').html();
		rez_calc+="<br/><b>Дополнительные элементы:</b>";
		$('#calc_wrap ul[data-calc="2"] li.select, #calc_wrap ul[data-calc="10"] li.select').each(function(){
			rez_calc+=" "+$(this).html();
		});
		rez_calc+="<br/><b>Холодильник:</b> "+$('#calc_wrap ul[data-calc="4"] li.select').html();
		rez_calc+="<br/><b>Плита:</b> "+$('#calc_wrap ul[data-calc="5"] li.select').html();
		rez_calc+="<br/><b>Вытяжка:</b> "+$('#calc_wrap ul[data-calc="6"] li.select').html();
		rez_calc+="<br/><b>Дополнительная техника:</b>";
		$('#calc_wrap ul[data-calc="7"] li.select').each(function(){
			rez_calc+=" "+$(this).html();
		});
		rez_calc+="<br/><b>Верхние шкафы:</b> "+$('#calc_wrap ul[data-calc="8"] li.select').html();
		rez_calc+="<br/><b>Фурнитура:</b> "+$('#calc_wrap ul[data-calc="9"] li.select').html();
		/*************************/
		$('#popup input[name="dob"]').val(rez_calc);

		$("#popup_bg").fadeIn(300);
		$("#popup").fadeIn(300);
		pos($("#popup"));
	});
	/****************************/

	/****** ОТПРАВКА ПИСЕМ ***************/
	$('#popup button.b').click(function(e){
		e.preventDefault();
		var tema = $('#popup input[name="tema"]').val();
		var dob = $('#popup input[name="dob"]').val();
		var phone=$('#popup input[name="phone"]').val();
		ots = 1;
		if (phone=="")
		{
			$('#popup input[name="phone"]').addClass("err");
		}
		if(!$('#popup input').hasClass('err'))
		{
			var name=$('#popup input[name="name"]').val();
			if (name=="") name="Не указано";
			var formData = new FormData();
			formData.append("form", 1);
			formData.append("name", name);
			formData.append("phone", phone);
			formData.append("tema", tema);
			formData.append("dob", dob);
			send_ajax (formData);
		}

	});
	
	$('#tz button.b').click(function(e){
		e.preventDefault();
		var tema = $('#tz input[name="tema"]').val();
		var dob = $('#tz input[name="dob"]').val();
		var phone=$('#tz input[name="phone"]').val();
		ots = 1;
		if (phone=="")
		{
			$('#tz input[name="phone"]').addClass("err");
		}
		if(!$('#tz input').hasClass('err'))
		{
			var name=$('#tz input[name="name"]').val();
			if (name=="") name="Не указано";
			var formData = new FormData();
			formData.append("form", 1);
			formData.append("name", name);
			formData.append("phone", phone);
			formData.append("tema", tema);
			formData.append("dob", dob);
			send_ajax (formData);
		}

	});


});