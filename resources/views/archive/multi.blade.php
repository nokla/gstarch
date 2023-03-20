@extends('layouts.psd')

@section('title')
    {{ __('Charger Multiple Documents') }}
@endsection
@section('main')
<div class="app-card shadow-sm mb-4 border-top-decoration bg-white" role="alert">
        <div class="app-card-body p-3">
            <form method="POST" action="{{ route('doc.mupload') }}" enctype="multipart/form-data"  class="row g-3">
                @csrf
                <div class="row m-4 p-3 mx-auto">
                    <div class="col-md-12 col-lg-12">
                        <div class="app-card-body h-100">
                            <label for="archive" class="form-label">Archive</label>
                            <div class="input-group mb-3">
                                <input type="text"  class="form-control" name="archive" id="archive" value="{{ $arc->sPath }}" readonly required>
                                <button class="btn btn-warning text-white" type="button" id="newdoss">Nouveau Dossier</button>
                            </div>
                            <label for="partage" class="form-label">Partage</label>
                            <div class="input-group">
                                <select name="partage" id="partage" class="form-select">
                                    <option value="1">Pas de partage</option>
                                    <option value="2">Avec Service</option>
                                    <option value="3">Avec Division</option>
                                    <option value="4">Avec Toute Division</option>
                                    <option value="5">Public</option>
                                </select>
                                <button type="button" class="btn app-btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                    Partage Personnalisé
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12">
                            @csrf
                            <div class="col-12">
                                <label for="file" class="col-sm-2 col-form-label">Fichiers</label>
                                <div class="col-sm-10">
                                    <input type="file"  class="form-control" id="file" name="files[]" multiple>
                                    <input type="hidden" name="ac" id="ac" value="{{ $arc->id }}">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-block w-100 text-white">Charger</button>
                            </div>

                    </div>
                </div>
            </form>
        </div>
</div>

@endsection

@section('script')
$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault(); // Prevent the form from submitting normally

        var year = new Date().getFullYear(); // Get the current year
        var formData = new FormData($(this)[0]); // Create a new FormData object

        // Append the year to the form data as a new field
        formData.append('year', year);

        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function(data) {
                alert(data); // Display the success message
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error: ' + errorThrown); // Display the error message
            }
        });
    });
    $('#newdoss').on('click', function(e){
        Swal.fire({
            title: 'Entrez un nom pour le dossier',
            input: 'text',
            inputPlaceholder: 'Nom',
            showCancelButton: true,
            confirmButtonText: 'Créer',
            cancelButtonText: 'Annuler',
            allowOutsideClick: false,
            inputValidator: (value) => {
              if (!value) {
                return 'Vous devez saisir un nom!'
              }
            }
          }).then((result) => {
            if (result.isConfirmed) {
              var name =  $('#archive').val()+'/'+result.value;
              var dav = {{ $arc->id }};

              $.post("{{ url('/api/newfoldertwo')}}", {psd: 4, nw: result.value, sr: dav, ty: name, je: 'je{{Auth::user()->id}}', '_token': '{{ csrf_token() }}'}, function(res){
                //alert(res);
                $('#ac').val(res.vD);
                $('#archive').val(name);
              });
              Swal.fire({
                title: 'Dossier ajouté!',
                icon: 'success'
              });
            }
          });

    });
});
@endsection
