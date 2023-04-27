<form id="booking_form">
    @csrf
    <div class="form-group row">
        <label for="name" class="col-sm-2 col-form-label">Name<span
                class="text-danger">*</span></label>
        <div class="col-sm-10" style="padding-bottom: 0.5rem">
            <input type="text" class="form-control @error('name') is-invalid @enderror"
                   id="name" name="name" placeholder="Enter Name"
                   required>
            <span id="name-error" class="text-danger block"></span>
        </div>
    </div>
    <div class="form-group row">
        <label for="cinema_id" class="col-sm-2 col-form-label">Cinema<span
                class="text-danger">*</span></label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="cinema_id" id="cinema_id" required>
                <x-adminlte-options :options="$cinemas"
                                    placeholder="-- Select Cinema --"/>
            </x-adminlte-select2>
        </div>
    </div>
    <div class="form-group row">
        <label for="movie_id" class="col-sm-2 col-form-label">Movies<span
                class="text-danger">*</span></label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="movie_id" id="movie_id" required>
                <x-adminlte-options :options="$movies"
                                    placeholder="-- Select Movie --"/>
            </x-adminlte-select2>
        </div>
    </div>
    <div class="form-group row">
        <label for="screen_id" class="col-sm-2 col-form-label">Screens<span
                class="text-danger">*</span></label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="screen_id" id="screen_id" required>
                <x-adminlte-options :options="isset($booking) ? '' : ''"
                                    placeholder="-- Select Screen --"/>
            </x-adminlte-select2>
        </div>
    </div>
    <div class="form-group row">
        <label for="show_id" class="col-sm-2 col-form-label">Shows<span
                class="text-danger">*</span></label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="show_id" id="show_id" required>
                <x-adminlte-options :options="isset($booking) ? '' : ''"
                                    placeholder="-- Select Show --"/>
            </x-adminlte-select2>
            <span id="show_id-error" class="text-danger block"></span>
        </div>

    </div>
    <div class="form-group row">
        <label for="ticket_count" class="col-sm-2 col-form-label">Total Tickets<span
                class="text-danger">*</span></label>
        <div class="col-sm-10">
            <x-adminlte-select2 name="ticket_count" id="ticket_count" required disabled>
                <x-adminlte-options :options="$ticketCount"
                                    placeholder="-- Total Tickets --"/>
            </x-adminlte-select2>
            <span id="ticket_count-error" class="text-danger block"></span>
        </div>
    </div>
</form>
