@extends('layouts.psd')

@section('title')
   PSD APPS-Archivage : Moteur de Recherche
@endsection

@section('cssfiles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .page-disabled {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5); /* semi-transparent black */
  z-index: 9999; /* ensure it's on top of other elements */
}

</style>
@endsection
@section('links')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">CRI</a></li>
      <li class="breadcrumb-item active" aria-current="page">Recherche</li>
    </ol>
  </nav>
@endsection

@section('main')
<hr class="divider">
@if (session('status'))

<div class="app-card alert alert-success alert-dismissible shadow-sm mb-4 border-left-decoration bg-white" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">PSD APPS-Archivage</h3>
            <div class="row gx-5 gy-3">
                <div class="col-12 col-lg-9">

                    <div>{{ session('status') }}</div>
                </div><!--//col-->
                <div class="col-12 col-lg-3">
                    {{ __('PSD APPS-Archivage') }}
                </div><!--//col-->
            </div><!--//row-->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div><!--//app-card-body-->

    </div><!--//inner-->
</div><!--//app-card-->
 @endif
 <div class="app-card app-card-accordion shadow-sm mb-4">
    <div class="app-card-body p-4 pt-0">
        <div id="faq1-accordion" class="faq1-accordion faq-accordion accordion">
            <div class="accordion-item">
                <h2 class="accordion-header" id="faq1-heading-1">
                  <button class="accordion-button btn btn-link" type="button" data-bs-toggle="collapse"  data-bs-target="#faq1-1" aria-expanded="false" aria-controls="faq1-1">
                    Recherche
                  </button>
                </h2>
                <div id="faq1-1" class="accordion-collapse collapse border-0" aria-labelledby="faq1-heading-1">
                    <div class="accordion-body text-start p4">
                        <form action="" method="post" id="frmsearch" name="frmsearch">
                            @csrf
                            @method('POST')
                            <div class="row mb-3 border-bottom border-primary p-2">
                                <label for="objet" class="col-sm-2 col-form-label col-form-label-sm">Objet :</label>
                                <div class="col-sm-10">
                                  <input type="text"  class="form-control form-control-sm" id="objet" name="objet" placeholder="Objet">
                                </div>
                            </div>
                            <div class="row mb-3  border-bottom border-primary p-2">
                                <label for="ref" class="col-sm-2 col-form-label col-form-label-sm">Réference : </label>
                                <div class="col-sm-10">
                                  <input type="text"  class="form-control form-control-sm" id="ref" name="ref" placeholder="ref">
                                </div>
                            </div>
                            <div class="row mb-3  border-bottom border-primary p-2">
                                <label for="tag" class="col-sm-2 col-form-label col-form-label-sm">Tags :</label>
                                <div class="col-sm-10">
                                  <input type="text"  class="form-control form-control-sm" id="tag" name="tag" placeholder="tag">
                                </div>
                            </div>
                            <div class="row mb-3  border-bottom border-primary p-2">
                                <label for="type" class="col-sm-2 col-form-label col-form-label-sm">Categorie :</label>
                                <div class="col-sm-10">
                                    <select class="form-select form-select-sm" id="type" name="type" aria-label=".form-select-sm example">
                                        <option value="-1" selected>Choisir</option>
                                        @foreach ($cat as $item)
                                            <option value="{{ $item->id}}">{{ $item->info }}</option>
                                        @endforeach
                                      </select>
                                </div>
                            </div>
                            <div class="row mb-3  border-bottom border-primary p-2">
                                <label for="dateDe" class="col-sm-2 col-form-label col-form-label-sm">De:</label>
                                <div class="col-sm-10">
                                  {{-- <input type="text"  class="form-control form-control-sm" id="daterange" name="daterange" value="{{ date('m-d-Y') /* $dOne */ }} - {{ date('m-d-Y') /* $dLast */ }}" /> --}}
                                  <input type="date"  class="form-control form-control-sm" id="dateDe" name="dateDe" />
                                </div>
                            </div>
                            <div class="row mb-3  border-bottom border-primary p-2">
                                <label for="dateAu" class="col-sm-2 col-form-label col-form-label-sm">Au:</label>
                                <div class="col-sm-10">
                                  {{-- <input type="text"  class="form-control form-control-sm" id="daterange" name="daterange" value="{{ date('m-d-Y') /* $dOne */ }} - {{ date('m-d-Y') /* $dLast */ }}" /> --}}
                                  <input type="date"  class="form-control form-control-sm" id="dateAu" name="dateAu" />
                                </div>
                            </div>

                            <input type="submit" class="btn app-btn-primary btn-block w-100" id="search4" value="Chercher">
                        </form>
                    </div>
                </div>
            </div><!--//accordion-item-->
        </div><!--//faq1-accordion-->
    </div><!--//app-card-body-->
</div><!--//app-card-->
<div id="page-disabled" class="page-disabled" style="display: none;"></div>


<div class="row my-4 gy-2">
    <div class="col-md-12">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                    <div id="result" class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="resultTbl">
                            <thead>
                                <tr>
                                    <th class="cell">#</th>
                                    <th class="cell">Document</th>
                                    <th class="cell">Ref</th>
                                    <th class="cell">Catégorie</th>
                                    <th class="cell">Date</th>
                                    <th class="cell"></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div><!--//table-responsive-->

                </div><!--//app-card-body-->
                <div class="app-card-footer">
                    <br>
                </div>
            </div>
    </div>
    </div>
</div>

@endsection

@section('jsfiles')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

@endsection
@section('script')
$('input[name="daterange"]').daterangepicker({
    opens: 'left'
  }, function(start, end, label) {
    console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
  });
  $('#search4').on('click', function (e){
    e.preventDefault();
    var frm = $("#frmsearch").serialize();
      // Show the waiting message before making the AJAX request
      $.ajax({
        url: '/result',
        type: 'POST',
        data: frm,
        beforeSend: function() {
          $('#page-disabled').show();
        },
        complete: function(res) {
          $('#page-disabled').hide();
        },
        success: function(response) {
            // handle success response
            $('#page-disabled').hide();

            //$('#result').html(response.data);
            $('#resultTbl tbody').empty();
            $('#resultTbl tbody').html(response.data)
            Swal.fire({
                title:'Recherche Terminée!',
                text: response.nb+' Document(s) trouvé(s)',
                icon: 'success'
              });
        },
        error: function(xhr, status, error) {
         alert(error);
         $('#page-disabled').hide();
        }
      });
  });



@endsection
