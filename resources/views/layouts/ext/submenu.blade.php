<ul class="submenu-list list-unstyled">
    @foreach ($cri as $item)
    <li class="nav-item has-submenu" style="margin-left: 9pt">
        <a class="nav-link submenu-toggle" href="#" data-bs-toggle="collapse" data-bs-target="#submenu{{$item->id}}" aria-expanded="false" aria-controls="submenu{{$item->id}}">
         <span class="nav-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
              </svg>
         </span>
            <span class="nav-link-text">{{$item->code}}</span>
                             <span class="submenu-arrow">
                                 <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                                </svg>
                                </span><!--//submenu-arrow-->
                        </a><!--//nav-link-->
                        <div id="submenu{{$item->id}}" class="collapse submenu submenu{{$item->id}}" data-bs-parent="#submenu-2">
                            <ul class="submenu-list list-unstyled">
                                @foreach ($item->services as $serv)
                                <li class="submenu-item"><a class="submenu-link" href="notifications.html">{{$serv->code}}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </li><!--//nav-item-->
    @endforeach
</ul>
