<script type="text/javascript">
// добавление обработчика события для объекта
function loginzaAddEvent (obj, type, fn){
	if (obj.addEventListener){
	      obj.addEventListener( type, fn, false);
	} else if(obj.attachEvent) {
	      obj.attachEvent( "on"+type, fn );
	} else {
	      obj["on"+type] = fn;
	}
}
// инициализация фиджета
function loginza_init_widget () {
	var loginza_wp_login = document.getElementById('loginform');
	loginza_wp_login.style.width = "359px";
	var loginza_loading = document.createElement("div");
	loginza_loading.id = "loginza_loading";
	loginza_loading.style.width = "359px";
	loginza_loading.style.marginTop = "112px";
	loginza_loading.style.paddingBottom = "122px";
	loginza_loading.style.textAlign = "center";
	loginza_loading.innerHTML = '<img src="%img_dir%loading.gif" alt="Loading..."/>';
	
	var loginza_iframe = document.createElement("iframe");
	loginza_iframe.id = "loginza_iframe";
	loginza_iframe.src = "https://%loginza_host%/api/widget?overlay=wp_plugin&token_url=%returnto_url%&providers_set=%providers_set%&lang=%lang%";
	loginza_iframe.style.display = "none";
	loginza_iframe.style.width = "359px";
	loginza_iframe.style.height = "300px";
	loginza_iframe.scrolling = "no";
	loginza_iframe.frameBorder = "no";
	// обработка события загрузки iframe с формой авторизации
	loginzaAddEvent(loginza_iframe, 'load', function () {
		loginza_iframe.style.display = "";
		loginza_loading.style.display = "none";
	});
	
	var loginza_header = document.createElement("div");
	loginza_header.id = "loginza_header";
	loginza_header.innerHTML ="<div style='color:red;'>%loginza_error%</div><h3>Или войдите используя Ваш логин и пароль:</h3><br/>";
	
	loginza_wp_login.insertBefore(loginza_header, loginza_wp_login.firstChild);
	loginza_wp_login.insertBefore(loginza_iframe, loginza_wp_login.firstChild );
	loginza_wp_login.insertBefore(loginza_loading, loginza_wp_login.firstChild );
}
// инициализация виджета
loginzaAddEvent(window, 'load', loginza_init_widget);
</script>