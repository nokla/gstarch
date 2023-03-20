@php
    //dd($cri);
@endphp
<div class="intro">
    <ul id="list-group list-group-flush myUL">
        <li class="list-group-item"><span class="caret">CRI</span>
          <ul class="list-group list-group-flush nested">
            <li class="list-group-item">Water</li>
            <li class="list-group-item">Coffee</li>
            @foreach ($cri as $key=>$item)
            <li class="list-group-item"><span class="caret">{{ $item->code}}</span>
              <ul class="list-group list-group-flush nested">
                <li class="list-group-item">Dossier 1</li>
                <li class="list-group-item">Dossier 2</li>
                @foreach ($item->Services as $val)
                <li class="list-group-item"><span class="caret">{{ $val->code }}</span>
                    <ul class="list-group list-group-flush nested">
                      <li class="list-group-item">Dossier 1</li>
                      <li class="list-group-item">Dossier 2</li>
                    </ul>
                  </li>
                @endforeach
              </ul>
            </li> 
            @endforeach
          </ul>
        </li>
      </ul>
      
</div>