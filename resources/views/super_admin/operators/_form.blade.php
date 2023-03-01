@if(Request::is('*/create'))
<form action="{{ route('operators.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
    <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="name">City ID</label>
            <input type="text" class="form-control" name="city_id" id="city_id" placeholder="Enter City ID" required>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" required>
            <label class="form-check-label" for="checkout">Check me out</label>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endif
@if(Request::is('*/edit'))
<form action="{{ route('operators.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
    <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" value="{{ $data->name }}" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="name">City ID</label>
            <input type="text" class="form-control" value="{{ $data->city_id }}" name="city_id" id="city_id" placeholder="Enter City ID" required>
        </div>

        <div class="form-check">
            <input type="checkbox" class="form-check-input" required>
            <label class="form-check-label" for="checkout">Check me out</label>
        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
@endif