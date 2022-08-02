<form action="{{ $user->exists ? route('users.update', $user) : route('users.store') }}" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
      <label for="name" class="form-label">Peran</label>
      <input value="{{ $user->name }}" class="form-control" id="name" required>
  </div>

  <button type="submit" class="btn btn-primary">{{ 'Simpan' }}</button>
</form>