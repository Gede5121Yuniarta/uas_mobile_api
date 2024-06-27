@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Edit Room</h1>
        <form action="{{ route('rooms.update', $room->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
                <label for="kost_id">Kost:</label>
                <select id="kost_id" name="kost_id" class="form-control" required>
                    @foreach ($kosts as $kost)
                        <option value="{{ $kost->id }}"
                            {{ old('kost_id', $room->kost_id) == $kost->id ? 'selected' : '' }}>
                            {{ $kost->name_kost }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="class_id">Class:</label>
                <select id="class_id" name="class_id" class="form-control" required>
                    @foreach ($roomClasses as $roomClass)
                        <option value="{{ $roomClass->id }}"
                            {{ old('class_id', $room->class_id) == $roomClass->id ? 'selected' : '' }}>
                            {{ $roomClass->classes_name }} - {{ $roomClass->price }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="rooms_name">Room Name:</label>
                <input type="text" id="rooms_name" name="rooms_name" class="form-control"
                    value="{{ old('rooms_name', $room->rooms_name) }}" required>
            </div>
            {{-- <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control">{{ old('description', $room->description) }}</textarea>
            </div> --}}
            <div class="form-group">
                <label for="description">Description:</label>
                <input id="description" name="description" type="hidden" value="{{ old('description', $room->description) }}">
                <trix-editor input="description" class="form-control"></trix-editor>
            </div>
            <div class="form-group">
                <label for="facilities">Facilities:</label>
                <div id="facilities-container" class="mb-2">
                    @if (old('facilities', json_decode($room->facilities, true)))
                        @foreach (old('facilities', json_decode($room->facilities, true)) as $facility)
                            <div class="input-group mb-2">
                                <input type="text" name="facilities[]" class="facility-input form-control"
                                    value="{{ $facility }}">
                                <div class="input-group-append">
                                    <button type="button" class="btn btn-danger" onclick="removeFacility(this)">-</button>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="input-group mb-2">
                            <input type="text" name="facilities[]" class="facility-input form-control">
                            <div class="input-group-append">
                                <button type="button" class="btn btn-danger" onclick="removeFacility(this)">-</button>
                            </div>
                        </div>
                    @endif
                </div>
                <button type="button" onclick="addFacility()" class="btn btn-sm btn-primary">
                    <i class="fa fa-plus"></i> Add Facility
                </button>
            </div>
            <div class="form-group">
                <label for="rooms_media">Media:</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="rooms_media" name="rooms_media[]" multiple
                        onchange="showUploadedFiles(this)">
                    <label class="custom-file-label" id="selectedFiles" for="rooms_media">Choose files</label>
                </div>
                @if ($room->rooms_media)
                    <p>Current Media: {{ $room->rooms_media }}</p>
                @endif
            </div>
            <hr>
            <div class="row">
                <div class="col-md-12 text-right">
                    <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        window.addFacility = function() {
            var container = document.getElementById('facilities-container');
            var div = document.createElement('div');
            div.className = 'input-group mb-2';
            div.innerHTML = `
                <input type="text" name="facilities[]" class="facility-input form-control">
                <div class="input-group-append">
                    <button type="button" class="btn btn-danger" onclick="removeFacility(this)">-</button>
                </div>
            `;
            container.appendChild(div);
        }

        window.removeFacility = function(button) {
            var container = document.getElementById('facilities-container');
            container.removeChild(button.parentElement.parentElement);
        }

        function showUploadedFiles(input) {
            var files = input.files;
            if (files.length > 0) {
                var filenames = [];
                for (var i = 0; i < files.length; i++) {
                    filenames.push(files[i].name);
                }
                document.getElementById('selectedFiles').textContent = filenames.join(", ");
            } else {
                document.getElementById('selectedFiles').textContent = "Choose files";
            }
        }
    </script>
@endsection
