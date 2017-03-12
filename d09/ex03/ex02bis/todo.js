function deleteTodo(todo)
{
	if (confirm("Do you want to remove that ToDo?"))
	{
		$(todo).remove();
		setCookie("todo", encodeURIComponent($("#ft_list").html()), 1);
	}
}

function setCookie(cname, cvalue, exdays) {
	var d = new Date();
	d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
	var expires = "expires="+d.toUTCString();
	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
	var name = cname + "=";
	var ca = document.cookie.split(';');
	for(var i = 0; i < ca.length; i++) {
		var c = ca[i];
		while (c.charAt(0) == ' ') {
			c = c.substring(1);
		}
		if (c.indexOf(name) == 0) {
			return c.substring(name.length, c.length);
		}
	}
	return "";
}

$(document).ready(function()
{
	$("#ft_list").html(decodeURIComponent(getCookie("todo")));

	$("#button").click(function()
	{
		var todo = prompt("Enter a ToDo");
		if (todo)
			todo = todo.trim();
		if (todo)
		{
			$("#ft_list").prepend("<div onclick=deleteTodo(this)>" + todo + "</div>");
			setCookie("todo", encodeURIComponent($("#ft_list").html()), 1);
		}
	});
});
