<div class="card mb-3 passenger-card">
    <div class="card-body">
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Given Name</span>
            </div>
            <input type="text" class="form-control" placeholder="Given Name" name="given_name[]" value="{{ $passenger->given_name }}">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Surname</span>
            </div>
            <input type="text" class="form-control" placeholder="Surname" name="surname[]" value="{{ $passenger->surname }}">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Email</span>
            </div>
            <input type="text" class="form-control" placeholder="Email" name="email[]" value="{{ $passenger->email }}">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Mobile</span>
            </div>
            <input type="text" class="form-control" placeholder="Mobile" name="mobile[]" value="{{ $passenger->mobile }}">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Date of Birth</span>
            </div>
            <input type="text" class="form-control" placeholder="e.g. 1994-02-04" name="dob[]" value="{{ $passenger->birth_date }}">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Passport</span>
            </div>
            <input type="text" class="form-control" placeholder="Passport" name="passport[]" value="{{ $passenger->passport }}">
        </div>
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <span class="input-group-text">Special Request</span>
            </div>
            <input type="text" class="form-control" placeholder="Special Request" name="special_request[] value="{{ $passenger->pivot->specail_request }}""
                   value="">
        </div>
        <div class="well well-sm">
            <button type="button" class="btn btn-danger mb-2 remove-passenger">Remove</button>
        </div>
    </div>
</div>
