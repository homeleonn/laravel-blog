@if ($errors->any())
<div style="background: #ffaeae; margin: 10px 5px; padding: 10px; font-weight: bold; border-radius: 10px;margin-left: 230px;">
	<ul style="margin: 0;">
	@foreach ($errors->all() as $error)
		<li>{{ $error }}</li>
	@endforeach
	</ul>
</div>
@endif