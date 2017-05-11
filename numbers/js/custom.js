$(document).ready(function () {
 
    // This makes the link inside the iframe open in parent window
    $('a.colorbox').click(function (event) {
        event.preventDefault(); // this just cancels the default link behavior.
        parent.showColorBox($(this).attr("href")); //this makes the parent window load the showColorBox function, using the a.colorbox href value
    });

});

//This function only needs to be available in the parent window, but no harm in loading it for both. Notice this is NOT in the $(document).ready on purpose.
function showColorBox(imageURL) {
    $.fn.colorbox({ innerWidth: "850px", innerHeight: "550px", iframe: true, transition: "elastic", opacity: .6, open: true, href: imageURL });
}