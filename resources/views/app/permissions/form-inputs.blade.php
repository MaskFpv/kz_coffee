@php $editing = isset($permission); @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ old('name', $editing ? $permission->name : '') }}">
    </div>

    <div class="form-group col-sm-12 mt-4">
        <h4>Assign {{ __('crud.roles.name') }}</h4>

        @foreach ($roles as $role)
            <div>
                <input type="checkbox" id="role{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                    {{ isset($permission) && $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                <label for="role{{ $role->id }}">{{ ucfirst($role->name) }}</label>
            </div>
        @endforeach
    </div>
</div>
