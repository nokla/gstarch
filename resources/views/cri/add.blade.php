@extends('layouts.psd')

@section('title')
    {{ __('Département CRI') }}
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
                    {{ __('Oky') }}
                </div><!--//col-->
            </div><!--//row-->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div><!--//app-card-body-->
        
    </div><!--//inner-->
</div><!--//app-card-->
 @endif
<div class="raw g-4 p-2">
    <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-header p-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h4 class="app-card-title">Ajout Département</h4>
                </div><!--//col-->
            </div><!--//row-->
        </div>
        <div class="app-card-body">
            <form action="{{route('cri.add')}}" name="save" class="settings-form" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="depart" class="form-label">Département</label>
                    <input type="text" class="form-control" id="depart" name="depart" value="Département." required="">
                    <input type="hidden" name="tp" value="1">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                      Générer l'archive?
                    </label>
                  </div>
                <button type="submit" class="btn app-btn-primary">Ajouter le Département</button>
            </form>
        </div><!--//app-card-body-->
        
    </div>
    <hr class="my-4">
    <div class="app-card app-card-settings shadow-sm p-4">
        <div class="app-card-header p-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-auto">
                    <h4 class="app-card-title">Ajout Service</h4>
                </div><!--//col-->
            </div><!--//row-->
        </div>
        <div class="app-card-body">
            <form action="{{route('cri.add')}}" name="save" class="settings-form" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="divs" class="form-label">Division</label>
                    <select name="divs" id="divs" class="form-select">
                        @foreach ($divs as $item)
                            <option value="{{ $item->id }}">{{ $item->division }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="serv" class="form-label">Service</label>
                    <input type="text" class="form-control" id="serv" name="serv" value="Service." required="">
                    <input type="hidden" name="tp" value="2">
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                    <label class="form-check-label" for="flexCheckChecked">
                      Générer l'archive?
                    </label>
                  </div>
                <button type="submit" class="btn app-btn-primary">Ajouter le Service</button>
            </form>
        </div><!--//app-card-body-->
        
    </div>
</div>
 
 @endsection

@section('script')
    <script>
        // A $( document ).ready() block.
        $( document ).ready(function() {
            
        });
    </script>
@endsection