@extends('layouts.psd')

@section('title')
    Archive : Document ({{ $doc->ref }})
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
                    {{ __('GSTARCH') }}
                </div><!--//col-->
            </div><!--//row-->
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div><!--//app-card-body-->
        
    </div><!--//inner-->
</div><!--//app-card-->
 @endif
 <div class="row gy-4">
    <div class="col-12 col-lg-6">
        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                              </svg>
                        </div><!--//icon-holder-->
                        
                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Infos Document</h4>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body px-4 w-100">
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label mb-2"><strong>Objet</strong></div>
                            <div class="item-data">PV N°22 test de docuement</div>
                        </div><!--//col-->
                        <div class="col text-end">
                            <a class="btn-sm app-btn-secondary" href="#">Mise à jour</a>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Ref.</strong></div>
                            <div class="item-data">01/2021</div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Date</strong></div>
                            <div class="item-data">01/01/2021</div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
            </div><!--//app-card-body-->
            <div class="app-card-footer p-4 mt-auto">
               <a class="btn app-btn-secondary" href="#">Mise à jour les informations</a>
            </div><!--//app-card-footer-->
           
        </div><!--//app-card-->
    </div><!--//col-->
    <div class="col-12 col-lg-6">
        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                              </svg>
                        </div><!--//icon-holder-->
                        
                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Document</h4>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body px-4 w-100">
                
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Categorie</strong></div>
                            <div class="item-data">PV</div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Document</strong></div>
                            <div class="item-data">Consulter le document. </div>
                        </div><!--//col-->
                        <div class="col text-end">
                            <a class="btn-sm app-btn-secondary" href="#">Télécharger</a>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
            </div><!--//app-card-body-->
            
            <div class="app-card-footer p-4 mt-auto">
               <a class="btn app-btn-secondary" href="#">Téélcharger le document</a>
            </div><!--//app-card-footer-->
           
        </div><!--//app-card-->
    </div>
    <div class="col-12 col-lg-6">
        <div class="app-card app-card-account shadow-sm d-flex flex-column align-items-start">
            <div class="app-card-header p-3 border-bottom-0">
                <div class="row align-items-center gx-3">
                    <div class="col-auto">
                        <div class="app-icon-holder">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-info-square-fill" viewBox="0 0 16 16">
                                <path d="M0 2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V2zm8.93 4.588-2.29.287-.082.38.45.083c.294.07.352.176.288.469l-.738 3.468c-.194.897.105 1.319.808 1.319.545 0 1.178-.252 1.465-.598l.088-.416c-.2.176-.492.246-.686.246-.275 0-.375-.193-.304-.533L8.93 6.588zM8 5.5a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
                              </svg>
                        </div><!--//icon-holder-->
                        
                    </div><!--//col-->
                    <div class="col-auto">
                        <h4 class="app-card-title">Origine</h4>
                    </div><!--//col-->
                </div><!--//row-->
            </div><!--//app-card-header-->
            <div class="app-card-body px-4 w-100">
                
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Division </strong></div>
                            <div class="item-data">Direction</div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Service</strong></div>
                            <div class="item-data">Service</div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Date d'ajout</strong></div>
                            <div class="item-data">02/02/2023</div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
                <div class="item border-bottom py-3">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-auto">
                            <div class="item-label"><strong>Utilisateur</strong></div>
                            <div class="item-data">Admin</div>
                        </div><!--//col-->
                    </div><!--//row-->
                </div><!--//item-->
            </div><!--//app-card-body-->
            <div class="app-card-footer p-4 mt-auto">
               ...
            </div><!--//app-card-footer-->
           
        </div><!--//app-card-->
    </div><!--//col-->
    
</div><!--//row-->
 
 @endsection

@section('script')

@endsection