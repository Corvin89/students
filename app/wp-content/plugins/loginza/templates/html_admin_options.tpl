<script src="/wp-content/plugins/loginza/js/jquery-1.4.2.min.js"></script>
<script src="/wp-content/plugins/loginza/js/jquery-ui-1.8.4.sortable.min.js"></script>
<style>
	ul.provider_choice {
		list-style-type: none; margin: 0; padding: 0;
		width:410px
	}
	td.provider_choice {
		background-color:#efefef;
		border:1px solid #fefefel;
		padding:10px;
	}
	ul.provider_choice li {
		margin: 5px 10px; padding: 0px; float: left; text-align: center;
		background-position:0 0;
		background-repeat:no-repeat;
		background-image:url(https://s3-eu-west-1.amazonaws.com/s1.loginza.ru/img/widget/providers_sprite.png);
		cursor:hand;
		cursor:pointer;
		width:115px;
		height:25px;
		text-align:right;
	}
	li#provider_google {background-position:0 0}
	li#provider_yandex {background-position:0 -25px}
	li#provider_mailruapi {background-position:0 -50px}

	li#provider_vkontakte {background-position:0 -75px}
	li#provider_facebook {background-position:0 -100px}
	li#provider_twitter {background-position:0 -125px}

	li#provider_loginza {background-position:0 -150px}
	li#provider_myopenid {background-position:0 -175px}
	li#provider_webmoney {background-position:0 -200px}

	li#provider_rambler {background-position:0 -225px}
	li#provider_flickr {background-position:0 -250px}
	li#provider_lastfm {background-position:0 -275px}

	li#provider_openid {background-position:0 -300px}
	li#provider_verisign {background-position:0 -325px}
	li#provider_aol {background-position:0 -350px}

	li#provider_mailru {background-position:0 -375px}
	li#provider_steam {background-position:0 -400px}
	
	ul.provider_choice li.ui-selected {
		background:'';
		background-image:url('');
		background-color:#e7e7e7;
	}
</style>

<div class="wrap">
<h2>Настройка виджета Loginza</h2>

<form name="form2" method="post" action="" onSubmit="$('input[name=providers_set]').val($('#selectedProviders').sortable('toArray'));">
<p>
<b>Провайдеры</b>:<br/>
	<table>
		<tr>
			<td valign="top" class="provider_choice">
			<i>Набор кнопок виджета</i><br/>
				<ul id="selectedProviders" class="provider_choice"> 
			        %providers_set_saved%
			    </ul>
			</td>
			<td align="center">&rarr;<br/>&larr;</td>
			<td valign="top" class="provider_choice">
			<i>Доступные кнопки</i><br/>
				<ul id="listProviders" class="provider_choice">
					%providers_set_avalible%
				</ul>
			</td>
		</tr>
	</table>
	
<input type="hidden" name="providers_set" value=""/>
</p>

<p>
<b>Язык</b>:<br/>
<select name="lang">
	<option value="auto">Auto</option>
	%lang%
</select>
</p>

<span class="submit">
	<input type="submit" name="save_loginza" value="Сохранить" />
</span>
</form>
</div>

<script>
$("#selectedProviders").sortable({placeholder: "ui-selected", opacity: 0.6, revert: true, tolerance: 'pointer'});
$("#selectedProviders").disableSelection();

$("#selectedProviders li input").bind('click', loginzaRemoveProvider);
$("#listProviders li input").bind('click', loginzaAddProvider);

function loginzaAddProvider () {
	var item = $(this).parent(0).clone().appendTo("#selectedProviders");
	$('input', item).val('X').unbind('click').bind('click', loginzaRemoveProvider);
	$(this).parent(0).remove();
}
function loginzaRemoveProvider () {
	var item = $(this).parent(0).clone().appendTo("#listProviders");
	$('input', item).val('←').unbind('click').bind('click', loginzaAddProvider);
	$(this).parent(0).remove();
}
</script>