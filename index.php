<!DOCTYPE html>
<html>
<head>
	<title>Phonebook</title>
</head>
<body>

	<h1>Phonebook</h1>	

	<input type="text" name="contactName" id="cname" onkeypress="return /[a-z ]/i.test(event.key)" placeholder="Contact Name">
	<input type="text" name="contactNumber" id="cnumber" maxlength="11" pattern=".{11,}" title="Input 11 digit numbers" onkeypress="return /[0-9]/i.test(event.key)" placeholder="Contact number">
		<input type="button" id="ctr" name="submit" value="Add Contact">


	<h2>Contacts</h2>

	<div>
		<p id="display"></p>
	</div>

</body>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script type="text/javascript" src = "index.js"></script>

</html>