@php $editing = isset($role); @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ old('name', $editing ? $role->name : '') }}">
    </div>

    <div class="col-sm-12 mt-4">
        <h4>Assign {{ __('crud.permissions.name') }}</h4>

        @php $count = 0; @endphp
        @foreach ($permissions as $permission)
            @if ($count % 3 == 0)
                <div class="row">
            @endif
            <div class="col-sm-4">
                <div class="form-check">
                    <input type="checkbox" id="permission{{ $permission->id }}" name="permissions[]"
                        value="{{ $permission->id }}"
                        {{ isset($role) && $role->hasPermissionTo($permission) ? 'checked' : '' }}
                        class="form-check-input">
                    <label for="permission{{ $permission->id }}"
                        class="form-check-label">{{ ucfirst($permission->name) }}</label>
                </div>
            </div>
            @php $count++; @endphp
            @if ($count % 3 == 0 || $loop->last)
    </div>
    @endif
    @endforeach
</div>
</div>
