$(document).ready(function () {

    $(document).on("submit", "#searchbar", function(e){
        const searchTerm = $("#search-input").val();
        return  true;
    });

});
