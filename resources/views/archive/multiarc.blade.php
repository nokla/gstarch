@extends('layouts.psd')

@section('title')
    {{ __('Charger Multiple Documents') }}
@endsection

@section('cssfiles')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/themes/default/style.min.css" />
@endsection


@section('main')
<div class="col-md-12">
    <div id="res" class="shadow-sm mb-4 p-4 border-left-primary bg-white rounded text-center" style="display: none;">

    </div>
</div>
<div class="app-card w-100 p-4 m-4">
    <form method="POST" action="{{ route('doc.mupload') }}" enctype="multipart/form-data"  class="row g-3">
        @csrf
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <label for="archive" class="form-label">Archive</label>
                        <div class="input-group">
                            <input type="text"  class="form-control" name="archive" id="archive" value="{{ $arch->sPath }}" readonly required>
                            <button class="btn btn-primary text-white" type="button" id="selectdir" data-bs-toggle="modal" data-bs-target="#dossiers">Séléctionner</button>
                        </div>
                        <div class="my-3">
                            <button class="btn btn-danger text-white" type="button" id="newdoss">Nouveau Dossier</button>
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
                            <button type="button" class="btn app-btn-primary">
                                Partage Personnalisé
                            </button>
                        </div>
            </div>
            <div class="col-md-12 col-lg-12">
                    @csrf
                    <div class="col-auto m-4">
                        <label for="file" class="col-sm-2 col-form-label">Fichiers</label>
                        <div class="col-sm-10">
                            <input type="file"  class="form-control" id="file" name="files[]" multiple>
                            <input type="hidden" name="ac" id="ac" value="{{ $arch->id }}">
                        </div>
                    </div>
                    <div class="col-auto m-4">
                        <button type="submit" class="btn btn-primary btn-block w-100 text-white">Charger</button>
                    </div>

            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="dossiers" tabindex="-1" aria-labelledby="dossiersLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="dossiersLabel">Archive CRI</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <h2 class="m-2">Sélectionner l'emplacement</h2>
            <div id="folders"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('jsfiles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/jstree.min.js"></script>
@endsection

@section('script')
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
    $('#folders').jstree({
        'core' : {
            'data' : {
                'url' : '/api/gfolders',
                'dataType' : 'json'
            }
        }
    });

    $('#folders').on('select_node.jstree', function (e, data) {
        //var folderPath = data.node.id;
        var folderPath = data.node.original.pth;
        //alert('You clicked on folder ' + folderPath);
        $('#archive').val(folderPath);
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
              var p =  $('#archive').val();
                //alert(p);
              $.post("{{ url('/api/givemefolder')}}", {psd: 4, nw: result.value, pt: p, je: 'je{{Auth::user()->id}}', '_token': '{{ csrf_token() }}'}, function(res){
                $('#archive').val(res.dir);
              });
              Swal.fire({
                title: res.txt,
                icon: 'success'
              });
            }
          });

    });
@endsection
