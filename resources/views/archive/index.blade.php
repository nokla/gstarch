@extends('layouts.psd')

@section('title')
    Division : {{ $div->division }}
@endsection

@section('links')
<nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('home') }}">CRI</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{ $div->code }}</li>
    </ol>
  </nav>
@endsection

@section('main')
<hr class="divider">
@if (session('status'))

<div class="app-card alert alert-success alert-dismissible shadow-sm mb-4 border-left-decoration bg-white" role="alert">
    <div class="inner">
        <div class="app-card-body p-3 p-lg-4">
            <h3 class="mb-3">GstArch : Gestion des Archives</h3>
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
 @php
    // dd($div);
 @endphp
 <div class="row g-4 mb-4 overflow-auto">
     @foreach ($serv as $item)
     <div class="col-6 col-lg-3">
        <div class="app-card app-card-stat shadow-sm h-100">
            <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Service</h4>
                <div class="stats-figure">{{ $item->code}}</div>
            </div><!--//app-card-body-->
            <a class="app-card-link-mask " href="{{ route('arc.service', ['id'=>$item->id])}}"  data-bs-toggle="tooltip" data-bs-placement="top"  title="{{ $item->service }}"></a>
        </div>
     </div><!--//col-->
    @endforeach
</div>
<hr class="my-4">
<div class="row g-3 mb-4 align-items-center justify-content-end">
    <div class="col-auto">
         <div class="page-utilities">
            <div class="row g-2 justify-content-start justify-content-md-end align-items-center">
                <div class="col-auto">
                    <form class="docs-search-form row gx-1 align-items-center">
                        <div class="col-auto">
                            <input type="text" id="search-docs" name="searchdocs" class="form-control search-docs" placeholder="Chercher..">
                        </div>
                        {{-- <div class="col-auto">
                            <button type="submit" class="btn app-btn-secondary">Chercher</button>
                        </div> --}}
                    </form>

                </div><!--//col-->
                <div class="col-auto">

                    <select id="type" class="form-select w-auto">
                          <option selected="" value="Tous">Tous</option>
                          @foreach ($cat as $item)
                          <option value="{{ $item->category }}">{{ $item->category }}</option>
                          @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <div class="btn-group">
                        <a href="#"  class="btn app-btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-upload me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"></path>
                            <path fill-rule="evenodd" d="M7.646 1.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 2.707V11.5a.5.5 0 0 1-1 0V2.707L5.354 4.854a.5.5 0 1 1-.708-.708l3-3z"></path>
                            </svg> Charger</a>
                        <ul class="dropdown-menu">
                          <li><a class="dropdown-item" href="{{ route('doc.NewDoc', ['arc'=>$div->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-plus" viewBox="0 0 16 16">
                            <path d="M8 6.5a.5.5 0 0 1 .5.5v1.5H10a.5.5 0 0 1 0 1H8.5V11a.5.5 0 0 1-1 0V9.5H6a.5.5 0 0 1 0-1h1.5V7a.5.5 0 0 1 .5-.5z"/>
                            <path d="M14 4.5V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h5.5L14 4.5zm-3 0A1.5 1.5 0 0 1 9.5 3V1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h-2z"/>
                          </svg>&nbsp; Un Nouveau Document</a></li>

                          <li><a class="dropdown-item" href="{{ route('doc.multi', ['id'=>$div->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                            <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                            <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                          </svg>&nbsp; Charger Dossier</a></li>
                          <li><hr class="dropdown-divider"></li>
                        </ul>
                      </div>
                    <a class="btn app-btn-secondary" id="newfld" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder-plus" viewBox="0 0 16 16">
                        <path d="m.5 3 .04.87a1.99 1.99 0 0 0-.342 1.311l.637 7A2 2 0 0 0 2.826 14H9v-1H2.826a1 1 0 0 1-.995-.91l-.637-7A1 1 0 0 1 2.19 4h11.62a1 1 0 0 1 .996 1.09L14.54 8h1.005l.256-2.819A2 2 0 0 0 13.81 3H9.828a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 6.172 1H2.5a2 2 0 0 0-2 2zm5.672-1a1 1 0 0 1 .707.293L7.586 3H2.19c-.24 0-.47.042-.683.12L1.5 2.98a1 1 0 0 1 1-.98h3.672z"/>
                        <path d="M13.5 10a.5.5 0 0 1 .5.5V12h1.5a.5.5 0 1 1 0 1H14v1.5a.5.5 0 1 1-1 0V13h-1.5a.5.5 0 0 1 0-1H13v-1.5a.5.5 0 0 1 .5-.5z"/>
                      </svg>Nouveau Dossier</a>
                    <a class="btn app-btn-secondary" id="zipit" href="{{ route('arc.zip', ['id'=>$div->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-zip-fill" viewBox="0 0 16 16">
                        <path d="M8.5 9.438V8.5h-1v.938a1 1 0 0 1-.03.243l-.4 1.598.93.62.93-.62-.4-1.598a1 1 0 0 1-.03-.243z"/>
                        <path d="M4 0h8a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2zm2.5 8.5v.938l-.4 1.599a1 1 0 0 0 .416 1.074l.93.62a1 1 0 0 0 1.109 0l.93-.62a1 1 0 0 0 .415-1.074l-.4-1.599V8.5a1 1 0 0 0-1-1h-1a1 1 0 0 0-1 1zm1-5.5h-1v1h1v1h-1v1h1v1H9V6H8V5h1V4H8V3h1V2H8V1H6.5v1h1v1z"/>
                      </svg>Télécharger ZIP</a>
                </div>
            </div><!--//row-->
        </div><!--//table-utilities-->
    </div><!--//col-auto-->
</div>
<hr>
<nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
    <a class="flex-sm-fill text-sm-center nav-link" id="docs-tab" data-bs-toggle="tab" href="#docs" role="tab" aria-controls="docs" aria-selected="true">Documents</a>
    <a class="flex-sm-fill text-sm-center nav-link active"  id="doss-tab" data-bs-toggle="tab" href="#doss" role="tab" aria-controls="doss" aria-selected="false">Dossiers</a>
</nav>
<div class="tab-content" id="orders-table-tab-content">
    <div class="tab-pane fade show" id="docs" role="tabpanel" aria-labelledby="docs-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive p-3">
                    <table class="table app-table-hover mb-0 text-left" id="lstdocs">
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
                            @if (!empty($docs))
                                @foreach ($docs as $key=> $item)
                                <tr>
                                    <td class="cell">{{ $key + 1 }}</td>
                                    <td class="cell"><span class="truncate">{{ $item->sObjet }}</span></td>
                                    <td class="cell"><span class="truncate">{{ $item->sRef}}</span></td>
                                    <td class="cell"><span class="badge bg-success">{{ GetCaty($item->iCaty) }}</span></td>
                                    <td class="cell">{{ $item->dDte}}</td>
                                    <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ route('doc.show', ['doc'=>$item->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                    </svg></a></td>
                                </tr>
                                @endforeach
                            @else
                                <tr colspan=6>
                                    <td class="text-center">Pas de documents</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div><!--//table-responsive p-3-->

            </div><!--//app-card-body-->
            <div class="app-card-footer">
                <br>
                <div class=" mx-auto text-center">
                    {!! $docs->links('layouts.ext.pagination') !!}
                </div>
                <br>
            </div>
        </div>
    </div>
    <div class="tab-pane fade show active" id="doss" role="tabpanel" aria-labelledby="doss-tab">
        <div class="app-card app-card-orders-table shadow-sm mb-5">
            <div class="app-card-body">
                <div class="table-responsive p-3">
                    <table class="table app-table-hover mb-0 text-left" id="lstdocs">
                        <thead>
                            <tr>
                                <th class="cell">#</th>
                                <th class="cell">Dossier</th>
                                <th class="cell">Date Création</th>
                                <th class="cell">Créateur</th>
                                <th class="cell"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($doss as $key=> $item)
                            <tr>
                                <td class="cell">{{ $key + 1 }}</td>
                                <td class="cell"><span class="truncate">{{ $item->sNom }}</span></td>
                                <td class="cell">{{ $item->created_at }}</td>
                                <td class="cell"><span class="truncate">{{ $item->iby}}</span></td>
                                <td class="cell"><a class="btn btn-warning" href="{{ route('arc.folder', ['id'=>$item->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-folder2-open" viewBox="0 0 16 16">
                                    <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
                                  </svg></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div><!--//table-responsive p-3-->

            </div><!--//app-card-body-->
            <div class="app-card-footer">
                <br>
                <div class=" mx-auto text-center">
                    {!! $doss->links('layouts.ext.pagination') !!}
                </div>
                <br>
            </div>
        </div>
    </div>

</div>
<div class="row g-4 mb-4">

</div>
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myModalLabel">Nouveau Dossier</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div id="res">
                <form method="POST" action="/submit">
                    @csrf
                    <div class="form-group">
                        <label for="newfold">Nom Dossier :</label>
                        <input type="text" class="form-control" id="newfold" name="newfold">
                        <input type="hidden" name="src" id="src" value="{{ $div->id }}">
                        <input type="hidden" name="nav" id="nav" value="1">
                        <input type="hidden" name="tt" id="tt" value="d">
                        <input type="hidden" name="dd" id="dd" value="{{ $div->id }}">
                        <input type="hidden" name="stk" id="stk" value="{{ $div->token }}">
                    </div>
                </form>
            </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn app-btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <button type="button" id="cree" class="btn app-btn-primary">Créer</button>
        </div>
      </div>
    </div>
  </div>


 @endsection

@section('script')
$( document ).ready(function() {
    // Add event listener to input
    $("#search-docs").on("keyup", function() {
      // Get input value and convert to lowercase
      const filter = $(this).val().toLowerCase();

      // Loop through table rows and hide/show based on filter
      $("#lstdocs tbody tr").each(function() {
        const name = $(this).find("td:first").text().toLowerCase();
        const age = $(this).find("td:nth-child(2)").text().toLowerCase();
        const country = $(this).find("td:nth-child(3)").text().toLowerCase();

        if (name.includes(filter) || age.includes(filter) || country.includes(filter)) {
          $(this).show();
        } else {
          $(this).hide();
        }
      });
    });
    $("#type").change(function() {
        var selectedValue = $(this).val();

        if (selectedValue == "Tous") {
          $("#lstdocs tbody tr").show();
        } else {
          $("#lstdocs tbody tr").hide();
          $("#lstdocs tbody tr td:nth-child(4)").filter(function() {
            //alert($(this).text());
            return $(this).text() == selectedValue;
          }).parent().show();
        }
      });
      $('#newfld').click(function() {
        $('#myModal').modal('show');
    });
    $('#cree').on('click', function(e){
        e.preventDefault();
        //alert('ME');

        var newf = $('#newfold').val();
        var src = $('#src').val();
        var stk = $('#stk').val();
        var nv = $('#nav').val();
        var tt = $('#tt').val();
        var dd = $('#dd').val();
        var je = "je{{Auth::user()->id}}";

        //alert(stk);
        $.post("{{ url('/api/newfolder')}}", {psd: 1,je: je, nw: newf, nv: nv, sr: src,tt:tt, dd:dd, st: stk, '_token': '{{ csrf_token() }}'}, function(res){
            //alert(res);
            $('#res').html(res);
            window.location.reload();
          });
    });
});
@endsection
