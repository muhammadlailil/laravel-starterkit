$(function(){
    $('.eye_password').on('click', function(){
        if($(this).find('.fa').hasClass('fa-eye')){
            $(this).find('.fa').attr('class','fa fa-eye-slash');
            $('#password').attr('type','text')
        }else{
            $(this).find('.fa').attr('class','fa fa-eye')
            $('#password').attr('type','password')
        }
    })
    $('#confirm_password').on('keyup',function(){
        if($(this).val() == $('#password').val()){
            $('.check_password').show()
        }else{
            $('.check_password').hide()
        }
    })
    $('#password').on('keyup',function(){
        if($(this).val() == $('#confirm_password').val()){
            $('.check_password').show()
        }else{
            $('.check_password').hide()
        }
    })
})

const password = document.getElementById('password');
password.addEventListener('keyup', function() {
	const value = password.value;
	var secureTotal = 0,
		chars = 0,
		capitals = 0,
		numbers = 0,
		special = 0;
	(upperCase = new RegExp('[A-Z]')),
		(numbers = new RegExp('[0-9]')),
		(specialchars = new RegExp('([!,%,&,@,#,$,^,*,?,_,~])'));

	if (value.length >= 8) {
		chars = 1;
	} else {
		chars = -1;
	}
	if (value.match(upperCase)) {
		capitals = 1;
	} else {
		capitals = 0;
	}
	if (value.match(numbers)) {
		numbers = 1;
	} else {
		numbers = 0;
	}
	if (value.match(specialchars)) {
		special = 1;
	} else {
		special = 0;
	}

	secureTotal = chars + capitals + numbers + special;
	securePercentage = secureTotal / 4 * 100;

	checkStatus(securePercentage);
});

function checkStatus(percentage) {
	var status = 'Weak';
    if (percentage < 25) {
        $('.length-valid-password div').attr('class','week')
        status = 'Weak';
    }
	if (percentage >= 25) {
        $('.length-valid-password div').attr('class','week')
		status = 'Weak';
	}
	if (percentage >= 50) {
        $('.length-valid-password div').attr('class','medium')
		status = 'Medium';
	}
	if (percentage >= 75) {
        $('.length-valid-password div').attr('class','strong')
		status = 'Strong';
	}
	if (percentage >= 100) {
        $('.length-valid-password div').attr('class','very-strong')
		status = 'Very Strong';
	}
    document.querySelector('.status_password').innerHTML = status;
	
}
