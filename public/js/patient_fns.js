function evict_patient_caches() {
    $jwtToken = getCookie('accesstoken');
      $.ajax({
        url: PATIENT_SERVICE + '/cache/evict/all' ,
        type: 'PUT',
        headers: {
            'Authorization': 'Bearer ' + $jwtToken
        },
       // dataType: 'json',
        async: true,
        success: function (data) {
            //console.log(data);
            $('#details').html("");
            console.log("Success evicting patient caches")
            //get_all_patients();
        },
        error: function(data) {
            console.log("Error evicting patient caches");
        }
});
}