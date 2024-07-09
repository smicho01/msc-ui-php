$(document).ready(function() {

    $('#btn-add-friend').on('click', function(event){
        const userVisibleName = $(this).attr('data-user');
        console.log("Connecting with: ", userVisibleName)
    });

    $('#btn-remove-friend').on('click', function(event){
        const userVisibleName = $(this).attr('data-user');
        console.log("Removing connection with:" ,userVisibleName)
    });

});