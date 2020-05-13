// On click signup, hide login and show reg form
$("#signup").click((e) => {
    $("#default").slideUp("slow", () => {
        $("#alternate").slideDown("slow");
    });
});


// On click signin, hide reg and show signin form
$("#signin").click((e) => {
    $("#alternate").slideUp("slow", () => {
        $("#default").slideDown("slow");
    });
});

//Handle view base on _Post variable
function hideDefault() {
    $("#default").hide();
    $("#alternate").show();
}