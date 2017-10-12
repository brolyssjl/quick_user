@if (auth()->user()->role_id == 1)
  <select name="role_id">
    <option value="" disabled selected>Seleccione el rol...</option>
    @foreach ($roles as $role)
      @if ($user->role_id == $role->id)
        <option value="{{ $role->id }}" selected>{{ $role->role_name }}</option>
      @else
        <option value="{{ $role->id }}">{{ $role->role_name }}</option>
      @endif
    @endforeach
  </select>
  <label>Rol del usuario</label>
@else
  @if ($user->role_id == auth()->user()->role_id && auth()->user()->role_id == 1)
    <select name="role_id">
      <option value="" disabled selected>Seleccione el rol...</option>
      @foreach ($roles as $role)
        @if ($user->role_id == $role->id)
          <option value="{{ $role->id }}" selected>{{ $role->role_name }}</option>
        @else
          <option value="{{ $role->id }}">{{ $role->role_name }}</option>
        @endif
      @endforeach
    </select>
    <label>Rol del usuario</label>
  @else
    <select disabled>
      <option value="" disabled selected>Seleccione el rol...</option>
      @foreach ($roles as $role)
        @if ($user->role_id == $role->id)
          <option value="{{ $role->id }}" selected>{{ $role->role_name }}</option>
        @else
          <option value="{{ $role->id }}">{{ $role->role_name }}</option>
        @endif
      @endforeach
    </select>
    <label>Rol del usuario</label>
    <input type="hidden" name="role_id" value="{{ $user->role_id }}">
  @endif
@endif
