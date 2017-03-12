var button = document.getElementById("button");
var list = document.getElementById("ft_list");
list.innerHTML = decodeURIComponent(getCookie("todo"));

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

button.addEventListener("click", function()
{
	var todo = prompt("Enter a ToDo");
	if (todo)
		todo = todo.trim();
	if (todo)
	{
		var div = document.createElement("div");
		todo = document.createTextNode(todo);
		div.appendChild(todo);
		div.setAttribute("onclick", "deleteTodo(this)");
		list.insertBefore(div, list.firstChild);
		setCookie("todo", encodeURIComponent(list.innerHTML), 1);
	}
});

function deleteTodo(todo)
{
	if (confirm("Do you want to remove that ToDo?"))
	{
		list.removeChild(todo);
		setCookie("todo", encodeURIComponent(list.innerHTML), 1);
	}
}
