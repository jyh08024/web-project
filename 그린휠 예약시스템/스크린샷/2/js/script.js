$(function(){
	
	// 카드번호
	$(".cardPay > li > #cardNum").keyup(function() {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	
	// 무통장번호
	$(".cashPay > li > #phone").keyup(function() {
		this.value = this.value.replace(/[^0-9]/g, '');
	});
	
	// 검색예약
	$("#category").change(function() {
		var selected = $(this).find("option:selected");
		var category = selected.data("category");
		$(".div-category").each(function(e, el) {
			if($(el).attr("data-category") == category) {
				$(el).show().find('select, input').attr({
					'required' : true,
				}).removeAttr('disabled');
			} else {
				$(el).hide().find('select, input').removeAttr('required').attr('disabled', true);
			} 
		});
	});
	
	//검색예약 데이트피커
	$("#start2").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#end2").datepicker({ dateFormat: 'yy-mm-dd' });
	
	//예약하기 데이트피커
	$("#start").datepicker({ dateFormat: 'yy-mm-dd' });
	$("#end").datepicker({ dateFormat: 'yy-mm-dd' });
});
