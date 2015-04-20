$(function(){

	$("button.delete-button").on('click',function()
	{
		var id = $(this).attr('data-id');
		var uri = "/Todo/delete/"+id;

		// in the future update to use jQuery UI or something "prettier"
		// but for now this will work to confirm deletion
		if(confirm("Are you sure?\nThis will remove the item from the database."))
		{
			var request = $.ajax({
				url: uri,
				method: 'POST'
			});

			request.fail(function(msg){
				//console.log("Fail: "+msg);
				$(location).attr('href','/Todo')
			});

			request.success(function(msg){
				//console.log("Success: "+msg);
				$(location).attr('href','/Todo')
			});
		}
	});

	$("input[type='checkbox']").on('click',function() {
		var id = $(this).parent('label').attr('data-id');
		if($(this).prop('checked'))
		{
			$(this).parent('label').addClass('checked');
			$(this).parent('label').after('<button data-id="'+id+'" class="delete-button" type="botton">Delete</button>');
			$(this).parent('label').next('button').on('click',function() {
				var id = $(this).attr('data-id');
				var uri = "/Todo/delete/"+id;

				// in the future update to use jQuery UI or something "prettier"
				// but for now this will work to confirm deletion
				if(confirm("Are you sure?\nThis will remove the item from the database."))
				{
					var request = $.ajax({
						url: uri,
						method: 'POST'
					});

					request.fail(function(msg){
						//console.log("Fail: "+msg);
						$(location).attr('href','/Todo')
					});

					request.success(function(msg){
						//console.log("Success: "+msg);
						$(location).attr('href','/Todo')
					});
				}
			});
			// setup the ajax call after everything has been finished
			var request = $.ajax({
				url: '/Todo/finished/'+id,
				method: 'POST'
			});

			request.fail(function(msg) {
				console.log(msg);
			});

			request.success(function(msg) {
				console.log(msg);
			});
		}
		else
		{
			console.log("ajax to set status to not finished, remove delete button, update class");
			$(this).parent('label').removeClass('checked');
			$(this).parent('label').next('button').remove()
			// setup the ajax call after everything has been finished
			var request = $.ajax({
				url: '/Todo/unfinished/'+id,
				method: 'POST'
			});

			request.fail(function(msg) {
				console.log(msg);
			});

			request.success(function(msg) {
				console.log(msg);
			});
		}
	});

	$("input[type='submit']").on('click',function() {
		var todo_text = $(".form-container > input[type='text']").val();

		if(todo_text)
		{
			//console.log("Todo Text: "+todo_text);

			var request = $.ajax({
				url: '/Todo/create',
				method: 'POST',
				data: {'content': todo_text},
				dataType: 'html'
			});

			request.fail(function(msg) {
				// should figure out a way to setup flash messages
				$(location).attr('href','/Todo');
			});

			request.success(function(msg) {
				//console.log('Success: '+msg);
				$(location).attr('href','/Todo');
			});
		}
		else
		{
			//console.log('Do todo data passed');
		}
	});

});
