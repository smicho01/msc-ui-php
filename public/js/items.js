$(document).ready(function() {
  	console.log('Items.js imported');
  	
  	$('#btnLoadItems').on('click', function() {
  		$.post(
  				"/php_js/items.php",
  				{
  					urlcommand: 'getallitems'
  				}
  				)
  				.done(function(data){

  					const dataJson = JSON.parse(data);
  					const items = dataJson.items;
			
					$outputHTML = "";

					if(items.length > 0) {
						for(var i = 0; i < items.length; i ++) {
							$outputHTML += "<tr>";
					             $outputHTML += "<th>" + items[i]._id + "</th>";
					             $outputHTML += "<td>" + items[i].name + "</td>";
					             $outputHTML += "<td>" + items[i].condition + "</td>";
					             $outputHTML += "<td>" + items[i].initial_price + "</td>";
					        $outputHTML += "</tr>";
						}
					}

					$('#table_items_body').html($outputHTML);

				})
  				.fail(function(data){
  					console.log('some fail with jQuery post');
  				})
  				.always(function() {
				    
				});

  		});

 
});