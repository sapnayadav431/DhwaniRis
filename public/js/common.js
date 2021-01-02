$( document ).ready( function () {
	$('.selectAll').click(function (e) {
	    $(this).next('table').find('td input:checkbox').prop('checked', this.checked);
	});
});


function printDiv(divName) {
    var printContents = document.getElementById(divName).innerHTML;
    var originalContents = document.body.innerHTML;
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
}


$(function(){
 
	$('input[type="text"]').keyup(function()
	{
		var yourInput = $(this).val();
		re = /[`~!@#$%^&*()_|\=?;:'",<>\{\}\[\]\\\/]/gi;
		var isSplChar = re.test(yourInput);
		if(isSplChar)
		{
			var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|\=?;:'",<>\{\}\[\]\\\/]/gi, '');
			$(this).val(no_spl_char);
		}
	});
});
