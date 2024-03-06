@php $editing = isset($role); @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ old('name', $editing ? $role->name : '') }}">
    </div>

    <div class="form-group col-sm-12 mt-4">
        <h4>Assign {{ __('crud.permissions.name') }}</h4>

        @foreach ($permissions as $permission)
            <div>
                <input type="checkbox" id="permission{{ $permission->id }}" name="permissions[]"
                    value="{{ $permission->id }}"
                    {{ isset($role) && $role->hasPermissionTo($permission) ? 'checked' : '' }}>
                <label for="permission{{ $permission->id }}">{{ ucfirst($permission->name) }}</label>
            </div>
        @endforeach
    </div>
</div>
