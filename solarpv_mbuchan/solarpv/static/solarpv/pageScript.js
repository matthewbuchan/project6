//functions to load header/footer for each page
$(function(){
    $("#header").load("header.php");
    $("#sidebar").load("sidebar.php");
    $("#newsbar").load("newsbar.html");
    $("#footer").load("footer.html");
});

// Validation functions
var checkName = function(inputVal){
    if(inputVal){
        console.log("username entered");
        return true;
    }
}
var checkPass = function(inputVal){
    if(inputVal){
        console.log("password entered");
        return true;
    }
}
var checkEmail = function($inputVal){
    if(!$inputVal.match(/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/)){
        console.log("you're not good");
        return false;
    }
    else{ console.log("email validated"); return true;}
}

var checkPhone = function($inputVal){
    if(!$inputVal.match(/^([0-9]{3})-?([0-9]{3})-?([0-9]{4})$/)){
        console.log("bad phone number");
        return false;
    }
    else{ console.log("phone validated"); return true;}
}
var validateField = function($inputVal){
    //Field populated
    if($inputVal){
        if(!$inputVal === $emailAddress){
            if(!$inputVal === $phoneNumber){
                return true;
            }
            else{
                console.log("This is a phone number");
                // return checkPhone($inputVal);
            }
            
        }
        else{
            console.log("This is an email address");
            // return checkEmail($inputVal);
        }
    }
    else{
        //Field not populated
        return false;
    }
}    
