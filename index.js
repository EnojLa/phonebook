$(document).ready(function(){

	$(document).on("click", '#ctr', function(){
		
		var person = $('#cname').val();
		var number = $('#cnumber').val();
		var button = 'create';
		var c = confirm("are you sure you want to add this to contacts?");
		$('#cname').val('');
		$('#cnumber').val('');

		if (c == true) {

		$.post("phonebook.php",
		{
			contactName : person,
			contactNumber : number,
			button : button
		},

		function(result){
			alert(result);
			view();
		});
		}
	});

	function view() {

		var button = 'view';

		$.post("phonebook.php",
		{
	
			button : button
		},

		function(result){
			$('#display').html(result);

		});
	}
	view();

	$(document).on("click", '.btnedit', function(){

		var id = $(this).attr("index");

		$('.cname' + id).prop("disabled", false);
		$('.cnumber' + id).prop("disabled", false);
		$('.updated' + id).prop("disabled", false);
		$('.deleted' + id).prop("disabled", false);

		});
	
	$(document).on("click", '.btndelete', function(){

			var id = $(this).attr("deletes");
			var button = 'delete';
			var del = confirm("are you sure you want to delete this contacts?");

			if (del == true) {

			$.post("phonebook.php",
			{
				
				idNumber : id,
				button : button
			},

			function(result){
				alert(result);
				view();
		});

		}
	});
	
	$(document).on("click", '.btnupdate', function(){

			var id = $(this).attr("updates");
			var button = 'update';
			var contact_name = $('.cname' + id).val();
			var contact_number = $('.cnumber' + id).val();
			var up = confirm("are you sure you want to update this contacts?");

			if (up == true) {

			$.post("phonebook.php",
			{
				
				idNumber : id,
				contactName : contact_name,
				contactNumber : contact_number,
				button : button
			},

			function(result){
				alert(result);
				view();
		});
		}
	});

});
