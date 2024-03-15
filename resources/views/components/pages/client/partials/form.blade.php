<x-utils.form.container id="clientForm" :route="$route" :method="$method">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') ?? $client->name ?? ''}}">
        <small class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</small>
    </div>
    <div class="mb-3">
        <label for="cpf" class="form-label">CPF</label>
        <input type="text" id="cpf" name="cpf" class="form-control" value="{{ old('cpf') ?? $client->cpf ?? ''}}">
        <small class="text-danger">{{ $errors->has('cpf') ? $errors->first('cpf') : '' }}</small>
    </div>
    <div class="mb-3">
        <label for="birth_date" class="form-label">Birth date</label>
        <input type="date" id="birth_date" name="birth_date" class="form-control" value="{{ old('birth_date') ?? $client->birth_date ?? ''}}">
        <small class="text-danger">{{ $errors->has('birth_date') ? $errors->first('birth_date') : '' }}</small>
    </div>
    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone number</label>
        <input type="text" id="phone_number" name="phone_number" class="form-control" value="{{ old('phone_number') ?? $client->phone_number ?? ''}}">
        <small class="text-danger">{{ $errors->has('phone_number') ? $errors->first('phone_number') : '' }}</small>
    </div>
</x-utils.form.container>