$(function () {
  //! Hide the placeholder
    $("[placeholder]")
    .focus(function () {
        $(this).attr("data-text", $(this).attr("placeholder"));
        $(this).attr("placeholder", "");
    })
    .blur(function () {
        $(this).attr("placeholder", $(this).attr("data-text"));
    });

  //! Add Asterisk on required feild
    $("input").each(function () {
        if ($(this).attr("required") === "required") {
            $(this).after("<span class='asterisk'>*</span>");
        }
    });

    //! Convert the password type to text type
    const passFeild = $(".password") ; 
    $(".show-pass").hover(function (){
        passFeild.attr("type","text");
        $(this).attr("class", "show-pass fa fa-eye-slash fa-2x");
    },function(){
        passFeild.attr("type" , "password");
        $(this).attr("class", "show-pass fa fa-eye fa-2x");
    });

    //! Conforimation Message on button
    $(".confirm").click(function(){
        return confirm("Are you sure ?");
    })
});
