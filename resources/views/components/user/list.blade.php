<div class="card mb-4">
  	<div class="card-body">
		<h2 class="card-title">{{ $user['name'] }}</h2>
		<small class="text-muted">
			<span class="font-weight-bold">Company</span>: {{ $user['company'] }}
		</small>
		<small class="text-muted">
			<span class="font-weight-bold">Email</span>:
			<a href="mailto:{{ $user['email'] }}">{{ $user['email'] }}</a>
		</small>
		<p class="card-text">{{ $user['about'] }}</p>
	</div>
</div>