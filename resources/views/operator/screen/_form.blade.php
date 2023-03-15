@if(Request::is('*/create'))
<form action="{{ route('screens.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
    <div class="form-group">
            <label for="name">Cinema ID</label>
            <input type="text" class="form-control" name="cinema_id" id="cinema_id" placeholder="Enter Cinema ID" required>
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
<form action="{{ route('screens.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">

        <div class="form-group">
            <label for="name">Cinema ID</label>
            <input type="text" class="form-control" value="{{ $data->cinema_id }}" name="cinema_id" id="cinema_id" placeholder="Enter Cinema ID" required>
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