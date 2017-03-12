var i = 0;

function callSelect()
{
	$.getJSON("select.php", function(result)
	{
		$.each(result, function(j, field)
		{
			if (field)
			{
				var spl = field.split(";");
				i = parseInt(spl[0]) + 1;
				$("#ft_list").prepend("<div id=" + spl[0] + " onclick=deleteTodo(this)>" + decodeURIComponent(spl[1]) + "</div>");
			}
		});
	});
}

function deleteTodo(todo)
{
	if (confirm("Do you want to remove that ToDo?"))
	{
		$.get("delete.php", {id: $(todo).attr("id")}, function()
		{
			$("#ft_list").empty();
			callSelect();
		});
	}
}

$(document).ready(function()
{
	callSelect();

	$("#button").click(function()
	{
		var todo = prompt("Enter a ToDo");
		if (todo)
			todo = todo.trim();
		if (todo)
		{
			$.get("insert.php", {id: i, todo: encodeURIComponent(todo)}, function()
			{
				$("#ft_list").empty();
				callSelect();
			});
		}
	});
});
