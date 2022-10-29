function checkall(){
    var parent = document.getElementById("check");
    var input = document.getElementsByTagName("input");

    if (parent.checked === true) {
        for ( var i = 0; i < input.length; i++) {
            if (input[i].type == "checkbox" &&  input[i].checked == false) {
                input[i].checked = true;
            }
            
        }
    }
   else if (parent.checked === false) {
       for ( var i = 0; i < input.length; i++) {
           if (input[i].type== "checkbox" && input[i].checked == true) {
               input[i].checked = false;
           } 
       }
   }
}
