function store(){

    var name = document.getElementById('name');
    var email = document.getElementById('email');
    var pw = document.getElementById('pw');
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;

    if(name.value.length == 0){
        Swal.fire({
            title: 'Please, Fill',
            text: 'Please, Fill Input Field!',
            icon: 'info',
            confirmButtonText: 'OK'
            });

    }else if(pw.value.length == 0){
        Swal.fire({
            title: 'Please, Fill',
            text: 'Please, Fill Input Field!',
            icon: 'info',
            confirmButtonText: 'OK'
            });

    }else if(name.value.length == 0 && pw.value.length == 0){
        Swal.fire({
            title: 'Please, Fill',
            text: 'Please, Fill Input Field!',
            icon: 'info',
            confirmButtonText: 'OK'
            });

    }else if(pw.value.length > 8){
        Swal.fire({
            title: 'Only 8 Characters!',
            text: 'Maximum 8 Character Allowed In Password!',
            icon: 'info',
            confirmButtonText: 'OK'
            });

    }else if(!pw.value.match(numbers)){
        Swal.fire({
            title: 'Atleast One Numeric Character!',
            text: 'Use, Atleast One Numeric Character In Password!',
            icon: 'info',
            confirmButtonText: 'OK'
            });

    }else if(!pw.value.match(upperCaseLetters)){
        Swal.fire({
            title: 'Atleast One UpperCase Character!',
            text: 'Use, Atleast One UpperCase Character!',
            icon: 'info',
            confirmButtonText: 'OK'
            });

    }else if(!pw.value.match(lowerCaseLetters)){
        Swal.fire({
            title: 'Atleast One LowerCase Character!',
            text: 'Use, Atleast One LowerCase Character!',
            icon: 'info',
            confirmButtonText: 'OK'
            });

    }else{
        localStorage.setItem('name', name.value);
        localStorage.setItem('email', email.value),
        localStorage.setItem('pw', pw.value);
        Swal.fire({
            title: 'Registration Success',
            text: 'Your Registration Successful',
            icon: 'success',
            confirmButtonText: 'OK'
            });
            setTimeout(function() {
            window.location.href = "login.html";
        }, 4000); 
    }
}

//checking
function check(){
    var storedEmail = localStorage.getItem('email');
    var storedPw = localStorage.getItem('pw');


    var userEmail = document.getElementById('userEmail');
    var userPw = document.getElementById('userPw');

    if(userEmail.value == storedEmail && userPw.value == storedPw){
        Swal.fire({
            title: 'Login Success',
            text: 'Welcome To Our Website',
            icon: 'success',
            confirmButtonText: 'OK'
            });
            setTimeout(function() {
            window.location.href = "home2.html";
        }, 2000); 
        
       
    }else{
        Swal.fire({
            title: 'Invalid Information!',
            text: 'Invalid Id Or Password!',
            icon: 'error',
            confirmButtonText: 'OK'
            });
    }
}