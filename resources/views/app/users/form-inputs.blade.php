@php $editing = isset($user); @endphp

<div class="row">
    <div class="col-sm-12">
        <label for="name" class="form-label">Name</label>
        <input type="text" name="name" id="name" class="form-control"
            value="{{ old('name', $editing ? $user->name : '') }}" maxlength="255" placeholder="Name" required>
    </div>

    <div class="col-sm-12 mt-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control"
            value="{{ old('email', $editing ? $user->email : '') }}" maxlength="255" placeholder="Email" required>
    </div>

    <div class="col-sm-12 mt-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" id="password" class="form-control" maxlength="255"
            placeholder="Password" {{ !$editing ? 'required' : '' }}>
    </div>

    <div class="form-group col-sm-12 mt-4">
        <h4>Assign {{ __('crud.roles.name') }}</h4>

        @foreach ($roles as $role)
            <div>
                <input type="checkbox" id="role{{ $role->id }}" name="roles[]" value="{{ $role->id }}"
                    {{ isset($user) && $user->hasRole($role) ? 'checked' : '' }}>
                <label for="role{{ $role->id }}">{{ ucfirst($role->name) }}</label>
            </div>
        @endforeach
    </div>
</div>
