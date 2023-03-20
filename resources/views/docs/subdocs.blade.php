<div class="app-card app-card-orders-table shadow-sm mb-5">
    <div class="app-card-body">
        <div class="table-responsive">
            <table class="table app-table-hover mb-0 text-left">
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
                    @foreach ($docs as $key=> $item)
                    <tr>
                        <td class="cell">{{ $key + 1 }}</td>
                        <td class="cell"><span class="truncate">{{ $item->sObjet }}</span></td>
                        <td class="cell"><span class="truncate">{{ $item->sRef}}</span></td>
                        <td class="cell"><span class="badge bg-success">{{ GetCaty($item->iCaty) }}</span></td>
                        <td class="cell"></td>
                        <td class="cell"><a class="btn-sm app-btn-secondary" href="{{ route('doc.show', ['doc'=>$item->id]) }}"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                          </svg></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!--//table-responsive-->

    </div><!--//app-card-body-->
</div>
<hr class="my-4">
<div class="d-flex">
    {!! $docs->links() !!}
</div>
