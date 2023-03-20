@extends('layouts.psd')

@section('title')
    {{ __('PSD APPS-Archivage Explorer') }}
@endsection

@section('cssfiles')
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/themes/default/style.min.css" />
@endsection


@section('main')
<div class="app-card app-card-settings shadow-sm p-4">

    <div class="app-card-body">
        <div class="row m-4">
            <div class="col-md-4">
                <h4>Archive ({{$src}})</h4>
                <hr>
                <div id="folders"></div>
            </div>
            <div class="col-md-8">
                <h4>Détails</h4>
                <hr>
                <div id="expo"></div>
                <div class="app-card-body">
                    <div class="table-responsive">
                        <table class="table app-table-hover mb-0 text-left" id="listeExp">
                            <thead>
                                <tr>
                                    <th class="cell">N°</th>
                                    <th class="cell">Type</th>
                                    <th class="cell">Nom</th>
                                    <th class="cell">#</th>
                                </tr>
                            </thead>
                            <tbody>


                            </tbody>
                        </table>
                    </div><!--//table-responsive-->

                </div>

            </div>
        </div>
    </div><!--//app-card-body-->

</div>
@endsection



@section('jsfiles')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.3.11/jstree.min.js"></script>
@endsection

@section('script')
$('#folders').jstree({
    'core' : {
        'data' : {
            'url' : '/gfolders',
            'dataType' : 'json'
        }
    }
});

$('#folders').on('select_node.jstree', function (e, data) {
    //var folderPath = data.node.id;
    var folderPath = data.node.original.pth;
    //alert('You clicked on folder ' + folderPath);
    $.post("{{ url('/api/explore')}}", {psd: 5, pat: folderPath,  '_token': '{{ csrf_token() }}'}, function(res){
        $('#listeExp tbody').empty();
        $('#listeExp tbody').append(res.expo);
      });
});
@endsection
