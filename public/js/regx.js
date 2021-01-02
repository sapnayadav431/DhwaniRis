     // regex 
     var address_regex = /^[/a-zA-Z0-9,.-\s]{0,50}$/;
     var email_regex = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/;
     var gst_regex = /^([0][1-9]|[1-2][0-9]|[3][0-5])([a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}[1-9a-zA-Z]{1}[zZ]{1}[0-9a-zA-Z]{1})+$/;
     var pan_regex = /^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/;
     var onlyAphabets_regex = /^[a-zA-Z ]{0,50}$/; //This will take only alphabets and the space.
     var onlyAphabetsNotSpace_regex = /^[a-zA-Z]{0,50}$/; //This will take only alphabets without the space.
     var onlyNumbers_regex = /^[0-9]{0,20}$/; //This will take only numbers and the no spaces.
     var onlyMobileNo_regex = /^[0-9]{10}/; //This will take only mobile number numbers and the no spaces.
     var onlyLandlineNo_regex = /^[0-9]{10,15}/;
     var onlyPinNo_regex = /^[0-9]{6}/; //This will take only Pin Code number numbers and the no spaces.
     var date_regex = /^[0-9]{4}-[0-9]{2}-[0-9]{2}/;
     var aadhar_regex = /^[0-9]{4}[0-9]{4}[0-9]{4}$/;
     var qualification_regex = /^[/a-zA-Z0-9,+.-\s]{0,50}$/;
     var onlyChequeNo_regex = /^[0-9]{6}/; //This will take only Cheque number numbers and the no spaces.
     var mobileno_regex = /^\+?([0-9]{2})\)?[-. ]?([0-9]{4})[-. ]?([0-9]{4})$/;
     // var allow_regex = /^[/a-zA-Z0-9,.-()\s]{0,50}$/;
      // regex end 