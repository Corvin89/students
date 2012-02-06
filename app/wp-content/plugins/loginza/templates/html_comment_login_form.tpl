<style>
a.loginza:hover, a.loginza {text-decoration:none;}
a.loginza img {border:0px;margin-right:3px;}
</style>
<script src="http://%loginza_host%/js/widget.js" type="text/javascript"></script>
<script type="text/javascript">
var loginza_auth = document.createElement("div");
loginza_auth.id = "loginza_comment";
loginza_auth.innerHTML = 'Также Вы можете войти используя: <a href="https://%loginza_host%/api/widget?token_url=%returnto_url%&providers_set=%providers_set%&lang=%lang%" class="loginza">'+
	'<img src="%img_dir%yandex.png" alt="Yandex" title="Yandex"/>&nbsp;<img src="%img_dir%google.png" alt="Google" title="Google Accounts"/>&nbsp;'+
	'<img src="%img_dir%vkontakte.png" alt="Вконтакте" title="Вконтакте"/>&nbsp;<img src="%img_dir%mailru.png" alt="Mail.ru" title="Mail.ru"/>&nbsp;<img src="%img_dir%twitter.png" alt="Twitter" title="Twitter"/>&nbsp;'+
	'<img src="%img_dir%loginza.png" alt="Loginza" title="Loginza"/>&nbsp;<img src="%img_dir%myopenid.png" alt="MyOpenID" title="MyOpenID"/>&nbsp;'+
	'<img src="%img_dir%openid.png" alt="OpenID" title="OpenID"/>&nbsp;<img src="%img_dir%webmoney.png" alt="WebMoney" title="WebMoney"/>&nbsp;'+
	'</a>';
var commentForm = document.getElementById("comment");
if (commentForm) {
	commentForm.parentNode.insertBefore(loginza_auth, commentForm);
}
</script>