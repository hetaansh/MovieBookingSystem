@if(Request::is('*/create'))
<form action="{{ route('cities.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="name">State ID</label>
            <select name="state_id" id="state_id" class="form-control">
                <option> -- Select One --</option>
                @foreach ($data as $states)
                <option value="{{$states->id}}">{{ $states->name }}</option>
                @endforeach
            </select>
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
<form action="{{ route('cities.update', $data->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="card-body">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{ $data->name }}" class="form-control" name="name" id="name" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="name">State ID</label>
            <select name="state_id" id="state_id" class="form-control">
                <option> -- Select One --</option>
                @foreach ($states as $states)
                <option value="{{$states->id}}">{{ $states->name }}</option>
                @endforeach
            </select>
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