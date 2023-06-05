$(function(){
    $(".link_show_settings").on("click", function(){
        $(this).hide(300);
        $(".settings_avatar").slideDown(300);
    });

    $(".link_hide_settings").on("click", function(){
        $(".settings_avatar").slideUp(300);
        $(".link_show_settings").show(300);
    });
});