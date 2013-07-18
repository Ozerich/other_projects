<? if ($this->is_guest): ?>
	<div class="guest-header">
		<div class="user-block">
			<h1><?=$this->baby->name?></h1>
			<a href="/baby">Вернуться в свой профиль</a>
		</div>
		<div class="other-users">
			<label for="other_users">Мои друзья:</label>
			<select id="other_users">
				<option value="0">Выберите друга для просмотра</option>
				<? foreach(Yii::app()->user->model()->getOpenBabies() as $baby): ?>
					<option value="<?=$baby->id?>"><?=$baby->name?></option>
				<? endforeach; ?>
			</select>
		</div>
	</div>
	
	<script>
		$('#other_users').change(function(){
			var id = $(this).val();
			if(id != 0)
			{
				document.location.href = '/baby/' + id;
			}
		});
	</script>
<? endif; ?>