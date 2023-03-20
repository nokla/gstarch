@extends('layouts.psd')

@section('title')
    {{ __('Dashboard') }}
@endsection
@section('main')
<hr class="divider">
@if (session('status'))
                        <div class="alert alert-success" role="alert">

                        </div>
                        <div class="app-card alert alert-dismissible shadow-sm mb-4 border-left-decoration bg-white" role="alert">
                            <div class="inner">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h3 class="mb-3">PSD APPS-Archivage</h3>
                                    <div class="row gx-5 gy-3">
                                        <div class="col-12 col-lg-9">

                                            <div>{{ session('status') }}</div>
                                        </div><!--//col-->
                                        <div class="col-12 col-lg-3">
                                            <a class="btn app-btn-primary" href="https://themes.3rdwavemedia.com/bootstrap-templates/admin-dashboard/portal-free-bootstrap-admin-dashboard-template-for-developers/"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-file-earmark-arrow-down me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4 0h5.5v1H4a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V4.5h1V14a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2z"/>
                                            <path d="M9.5 3V0L14 4.5h-3A1.5 1.5 0 0 1 9.5 3z"/>
                                            <path fill-rule="evenodd" d="M8 6a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 10.293V6.5A.5.5 0 0 1 8 6z"/>
                                            </svg>{{ __('You are logged in!') }}</a>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div><!--//app-card-body-->

                            </div><!--//inner-->
                        </div><!--//app-card-->
                    @endif


                    <div class="row g-4 mb-4">
                        <div class="col-6 col-lg-3">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h4 class="stats-type mb-1">Documents</h4>
                                    <div class="stats-figure">400</div>
                                    <div class="stats-meta text-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-earmark-zip-fill" viewBox="0 0 16 16">
                                            <path d="M5.5 9.438V8.5h1v.938a1 1 0 0 0 .03.243l.4 1.598-.93.62-.93-.62.4-1.598a1 1 0 0 0 .03-.243z"/>
                                            <path d="M9.293 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V4.707A1 1 0 0 0 13.707 4L10 .293A1 1 0 0 0 9.293 0zM9.5 3.5v-2l3 3h-2a1 1 0 0 1-1-1zm-4-.5V2h-1V1H6v1h1v1H6v1h1v1H6v1h1v1H5.5V6h-1V5h1V4h-1V3h1zm0 4.5h1a1 1 0 0 1 1 1v.938l.4 1.599a1 1 0 0 1-.416 1.074l-.93.62a1 1 0 0 1-1.109 0l-.93-.62a1 1 0 0 1-.415-1.074l.4-1.599V8.5a1 1 0 0 1 1-1z"/>
                                          </svg> Archivé(s)</div>
                                </div><!--//app-card-body-->
                                <a class="app-card-link-mask" href="#"></a>
                            </div><!--//app-card-->
                        </div><!--//col-->
                        <div class="col-6 col-lg-3">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h4 class="stats-type mb-1">Départements</h4>
                                    <div class="stats-figure">5</div>
                                    <div class="stats-meta text-success">
                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                        </svg> Engagé(s)
                                    </div>
                                </div><!--//app-card-body-->
                                <a class="app-card-link-mask" href="#"></a>
                            </div><!--//app-card-->
                        </div><!--//col-->
                        <div class="col-6 col-lg-3">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h4 class="stats-type mb-1">Utilisateurs</h4>
                                    <div class="stats-figure">10</div>
                                    <div class="stats-meta">
                                        Enregistré</div>
                                </div><!--//app-card-body-->
                                <a class="app-card-link-mask" href="#"></a>
                            </div><!--//app-card-->
                        </div><!--//col-->
                        <div class="col-6 col-lg-3">
                            <div class="app-card app-card-stat shadow-sm h-100">
                                <div class="app-card-body p-3 p-lg-4">
                                    <h4 class="stats-type mb-1">Consultation</h4>
                                    <div class="stats-figure">60</div>
                                    <div class="stats-meta">Docs</div>
                                </div><!--//app-card-body-->
                                <a class="app-card-link-mask" href="#"></a>
                            </div><!--//app-card-->
                        </div><!--//col-->
                    </div><!--//row-->
                    <div class="row g-4 mb-4">
                        <div class="col-md-5">
                            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                                <div class="app-card-header p-3 border-bottom-0">
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-file-break-fill" viewBox="0 0 16 16">
                                                    <path d="M4 0h8a2 2 0 0 1 2 2v7H2V2a2 2 0 0 1 2-2zM2 12h12v2a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2v-2zM.5 10a.5.5 0 0 0 0 1h15a.5.5 0 0 0 0-1H.5z"/>
                                                  </svg>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">Archive</h4>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//app-card-header-->
                                <div class="app-card-body px-4">

                                    <div class="intro">
                                        <ul id="myUL" class="list-group list-group-flush">
                                            <li class="list-group-item"><span class="caret">CRI</span>
                                                <ul  class="list-group list-group-flush nested">
                                                    @foreach($archives as $archive)
                                                        @if($archive->sNiv == 1)
                                                            <li  class="list-group-item">
                                                                <span class="caret"><a class="submenu-link totip" href="{{ route('arc.index', ['id'=>$archive->id]) }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $archive->sNom }}">{{ $archive->sNom }}</a></span>
                                                                <ul  class="list-group list-group-flush nested">
                                                                    @foreach($archives as $childArchive)
                                                                        @if($childArchive->sNiv == 2 && $childArchive->vid == $archive->id)
                                                                           @if ($niv==3)
                                                                            @if ($sdiv==$childArchive->sNom)
                                                                            <li  class="list-group-item"><a class="submenu-link totip" href="{{ route('arc.service', ['id'=>$idy]) }}"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $childArchive->sNom }}"><i class="fa fa-circle-arrow-right"></i> {{ $childArchive->sNom }}</a></li>
                                                                            @endif
                                                                           @else
                                                                           <li  class="list-group-item"><a class="submenu-link totip" href="#"  data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $childArchive->sNom }}"><i class="fa fa-circle-arrow-right"></i> {{ $childArchive->sNom }}</a></li>
                                                                           @endif
                                                                        @endif
                                                                    @endforeach
                                                                </ul>
                                                            </li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </li>
                                          </ul>

                                    </div>
                                </div><!--//app-card-body-->
                                <div class="app-card-footer p-4 mt-auto">
                                   <a class="btn app-btn-secondary" href="#">Aperçu</a>
                                </div><!--//app-card-footer-->
                            </div><!--//app-card-->
                        </div>
                        <div class="col-md-7">
<div class="row g-4 mb-4">

                        <div class="col-12 col-lg-6">
                            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                                <div class="app-card-header p-3 border-bottom-0">
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bookmark-star" viewBox="0 0 16 16">
                                                    <path d="M7.84 4.1a.178.178 0 0 1 .32 0l.634 1.285a.178.178 0 0 0 .134.098l1.42.206c.145.021.204.2.098.303L9.42 6.993a.178.178 0 0 0-.051.158l.242 1.414a.178.178 0 0 1-.258.187l-1.27-.668a.178.178 0 0 0-.165 0l-1.27.668a.178.178 0 0 1-.257-.187l.242-1.414a.178.178 0 0 0-.05-.158l-1.03-1.001a.178.178 0 0 1 .098-.303l1.42-.206a.178.178 0 0 0 .134-.098L7.84 4.1z"/>
                                                    <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                                                  </svg>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">Départements</h4>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//app-card-header-->
                                <div class="app-card-body px-4">

                                    <div class="intro">Ajouter, Consulter, modifier un Département.</div>
                                </div><!--//app-card-body-->
                                <div class="app-card-footer p-4 mt-auto">
                                   <a class="btn app-btn-secondary" href="#">Aperçu</a>
                                </div><!--//app-card-footer-->
                            </div><!--//app-card-->
                        </div><!--//col-->
                        <div class="col-12 col-lg-6">
                            <div class="app-card app-card-basic d-flex flex-column align-items-start shadow-sm">
                                <div class="app-card-header p-3 border-bottom-0">
                                    <div class="row align-items-center gx-3">
                                        <div class="col-auto">
                                            <div class="app-icon-holder">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                                    <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1H7Zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm-5.784 6A2.238 2.238 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.325 6.325 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1h4.216ZM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z"/>
                                                  </svg>
                                            </div><!--//icon-holder-->

                                        </div><!--//col-->
                                        <div class="col-auto">
                                            <h4 class="app-card-title">Utilisateurs</h4>
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//app-card-header-->
                                <div class="app-card-body px-4">

                                    <div class="intro">Gestion des utilisateurs.</div>
                                </div><!--//app-card-body-->
                                <div class="app-card-footer p-4 mt-auto">
                                   <a class="btn app-btn-secondary" href="#">Aperçu</a>
                                </div><!--//app-card-footer-->
                            </div><!--//app-card-->
                        </div><!--//col-->
                    </div>
                    <div class="row g-4 mb-4">
                        <div class="col-12 col-lg-6">
                            <div class="app-card app-card-progress-list h-100 shadow-sm">
                                <div class="app-card-header p-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h4 class="app-card-title">Suivi d'archivage</h4>
                                        </div><!--//col-->
                                        <div class="col-auto">
                                            <div class="card-header-action">
                                                <a href="#">Suivi</a>
                                            </div><!--//card-header-actions-->
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//app-card-header-->
                                <div class="app-card-body">
                                    <div class="item p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="title mb-1 ">Dir CRI</div>
                                                <div class="progress">
                                                 <div class="progress-bar bs-primay" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div><!--//col-->
                                            <div class="col-auto">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="item-link-mask" href="#"></a>
                                    </div><!--//item-->


                                     <div class="item p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="title mb-1 ">DC</div>
                                                    <div class="progress">
                                                    <div class="progress-bar bs-primay" role="progressbar" style="width: 34%;" aria-valuenow="34" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                            </div><!--//col-->
                                            <div class="col-auto">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="item-link-mask" href="#"></a>
                                    </div><!--//item-->

                                    <div class="item p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="title mb-1 ">DDSP</div>
                                                <div class="progress">
                                                <div class="progress-bar bs-primay" role="progressbar" style="width: 68%;" aria-valuenow="68" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div><!--//col-->
                                            <div class="col-auto">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                    </svg>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="item-link-mask" href="#"></a>
                                    </div><!--//item-->

                                    <div class="item p-3">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <div class="title mb-1 ">DOTP</div>
                                                <div class="progress">
                                                <div class="progress-bar bs-primay" role="progressbar" style="width: 52%;" aria-valuenow="52" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div><!--//col-->
                                            <div class="col-auto">
                                                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/>
                                                </svg>
                                            </div><!--//col-->
                                        </div><!--//row-->
                                        <a class="item-link-mask" href="#"></a>
                                    </div><!--//item-->

                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div><!--//col--><!--//col-->
                        <div class="col-12 col-lg-6">
                            <div class="app-card app-card-stats-table h-100 shadow-sm">
                                <div class="app-card-header p-3">
                                    <div class="row justify-content-between align-items-center">
                                        <div class="col-auto">
                                            <h4 class="app-card-title">Derniers Documents</h4>
                                        </div><!--//col-->
                                        <div class="col-auto">
                                            <div class="card-header-action">
                                                <a href="#">Historique</a>
                                            </div><!--//card-header-actions-->
                                        </div><!--//col-->
                                    </div><!--//row-->
                                </div><!--//app-card-header-->
                                <div class="app-card-body p-3 p-lg-4">
                                    <div class="table-responsive">
                                        <table class="table table-borderless mb-0">
                                            <thead>
                                                <tr>
                                                    <th class="meta">Source</th>
                                                    <th class="meta stat-cell">Views</th>
                                                    <th class="meta stat-cell">Today</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="#">google.com</a></td>
                                                    <td class="stat-cell">110</td>
                                                    <td class="stat-cell">
                                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-up text-success" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M8 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L7.5 2.707V14.5a.5.5 0 0 0 .5.5z"/>
                                        </svg>
                                                        30%
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">getbootstrap.com</a></td>
                                                    <td class="stat-cell">67</td>
                                                    <td class="stat-cell">23%</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">w3schools.com</a></td>
                                                    <td class="stat-cell">56</td>
                                                    <td class="stat-cell">
                                                        <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-arrow-down text-danger" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                          <path fill-rule="evenodd" d="M8 1a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L7.5 13.293V1.5A.5.5 0 0 1 8 1z"/>
                                        </svg>
                                                        20%
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">javascript.com </a></td>
                                                    <td class="stat-cell">24</td>
                                                    <td class="stat-cell">-</td>
                                                </tr>
                                                <tr>
                                                    <td><a href="#">github.com </a></td>
                                                    <td class="stat-cell">17</td>
                                                    <td class="stat-cell">15%</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div><!--//table-responsive-->
                                </div><!--//app-card-body-->
                            </div><!--//app-card-->
                        </div><!--//col-->
                    </div>
                        </div>
                    </div>


@endsection

@section('script')
var toggler = document.getElementsByClassName("caret");
var i;

for (i = 0; i < toggler.length; i++) {
toggler[i].addEventListener("click", function() {
    this.parentElement.querySelector(".nested").classList.toggle("active");
    this.classList.toggle("caret-down");
});
}
@endsection
