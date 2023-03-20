@extends('layouts.psd')

@section('title')
    ETest API
@endsection

@section('links')

@endsection

@section('cssfiles')
    <style>
        .item-data {
            font-size: 14pt;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
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
<form id="fileUploadForm" method="POST" action="{{ route('cri.gcrui') }}" enctype="multipart/form-data">
    @csrf
    <div class="col-md-12">
        <div id="res" class="shadow-sm mb-4 p-4 border-left-primary bg-white rounded text-center" style="display: none;">

        </div>
    </div>
    <div class="row gy-4">
        <div class="col-md-12">
            <div class="app-card app-card-settings shadow-sm p-4 h-100">
                <div class="app-card-header p-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <h4 class="app-card-title">Infos Crui</h4>
                        </div><!--//col-->
                    </div><!--//row-->
                </div>
                <div class="app-card-body h-100 p-2 m-2">
                    <div class="mb-3">
                        <label for="crui" class="form-label">Code CRUI :</label>
                        <input type="text" class="form-control" id="crui" name="crui"  placeholder="crui" required="">
                    </div>
                    <input type="submit" value="Generate" class="btn btn-primary">
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

@endsection
