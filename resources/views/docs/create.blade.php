@extends('layouts.psd')

@section('title')
    {{ __('Ajout Nouveau Document') }}
@endsection
@section('main')
<hr class="divider">
@if (session('status'))

<div class="app-card alert alert-success text-white alert-dismissible shadow-sm mb-4 border-left-decoration bg-white" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">GstArch : Gestion des Archives</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12 col-lg-9">

                    <div>{{ session('status') }}</div>
                </div><!--//col-->
                <div class="col-12 col-lg-3">
                    {{ __('Oky') }}
                </div><!--//col-->
            </div><!--//row-->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div><!--//app-card-body-->

    </div><!--//inner-->
</div><!--//app-card-->
 @endif
<form id="fileUploadForm" method="POST" action="{{ route('doc.upload') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12">
        <div id="res" class="shadow-sm mb-4 p-4 border-left-primary bg-white rounded text-center" style="display: none;">

        </div>
    </div>
    <div class="row m-4">
        <div class="col-md-6 h-100">
            <div class="app-card app-card-settings shadow-sm p-4 h-100">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Infos Document</h4>
                        </div><!--//col-->
                    </div><!--//row-->
                </div>
                <div class="app-card-body h-100">
                        <div class="mb-3">
                            <label for="objet" class="form-label">Objet:</label>
                            <input type="text" class="form-control" id="objet" name="objet" placeholder="Objet" required="">
                        </div>
                        <div class="mb-3">
                            <label for="ref" class="form-label">Référence :</label>
                            <input type="text" class="form-control" id="ref" name="ref" placeholder="Référence" required="">
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date du document</label>
                            <input type="date" class="form-control" id="date" name="date" required="">
                        </div>
                        <div class="mb-3">
                            <label for="categorie" class="form-label">Categorie</label>
                            <select name="categorie" id="categorie" class="form-select">
                                @foreach ($caty as $item)
                                    <option value="{{ $item->id }}">{{ $item->category }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tags" class="form-label">Tags:</label>
                            <select class="js-select2 form-control form-select select-control" id="tags" name="tags[]" multiple="multiple" style="width: 100%">
                                <option value="CRI">CRI</option>
                                <option value="Archive">Archive</option>
                              </select>
                        </div>
                </div><!--//app-card-body-->
            </div>
        </div>
        <div class="col-md-6 h-100">
            <div class="app-card app-card-settings shadow-sm p-4 h-100">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Options Archivage</h4>
                        </div><!--//col-->
                    </div><!--//row-->
                </div>
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
                      <hr class="mb-4">
                      <h4>Document:</h4>
                      <hr>
                      <div class="form-group mb-3">
                        <input name="file" type="file" class="form-control">
                    </div>
                    <div class="d-grid mb-3">
                        <input type="submit" value="Charger le document!" class="btn btn-warning">
                        <input type="hidden" name="ac" id="ac" value="{{ $arc->id }}">
                    </div>
                    <div class="form-group">
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          ...
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
 @endsection

@section('script')
$('#doits').click(function () {
    Swal.fire({
      title: 'Popup Title',
      text: $('#service').val()+'-'+$('#dossier').val(),
      icon: 'success',
      confirmButtonText: 'OK'
    });
  });
$('#fileUploadForm').ajaxForm({
    beforeSend: function () {
        var percentage = '0';
        $("#fileUploadForm :input").prop("disabled", true);
    },
    uploadProgress: function (event, position, total, percentComplete) {
        var percentage = percentComplete;
        $('.progress .progress-bar').css("width", percentage+'%', function() {
          return $(this).attr("aria-valuenow", percentage) + "%";
        })
    },
    complete: function (xhr) {
        console.log(xhr);
        //alert(xhr);
        $('#res').html(xhr.responseJSON.success);
        $('#res').animate().show(500);
        {{-- //$('#res').html(xhr.responseJSON.red); --}}
        setTimeout(function(){
            //window.location.reload();
            window.location = '/doc/'+xhr.responseJSON.red;
         }, 5000);
    },
    error:function (xhr) {
        console.log(xhr.responseJSON.errors);
        alert('Upload Error!');
        $('#res').html('Problème technique, verifier votre fichier, si le problème reste toujours Merci de contacter votre administrateur');
        $('#res').addClass('alert-danger bg-danger');
        $('#res').removeClass('bg-white');
        $('#res').animate().show(500);
       {{--  setTimeout(function(){
            window.location.reload();
         }, 5000); --}}
    }
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

          $.post("{{ url('/api/newfoldertwo')}}", {psd: 3, nw: result.value, sr: dav, ty: name, je: 'je{{Auth::user()->id}}', '_token': '{{ csrf_token() }}'}, function(res){
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
@endsection
