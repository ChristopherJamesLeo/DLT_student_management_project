@foreach ($packages as $idx => $package)
    <div class="col-lg-4 col-md-6 mb-4 border-0">
        <div class="card rounded-0 packages plans {{$userdata->package_id===$package->id ? 'shadow' : ''}}">
            <div class="card-title p-2">
               <h3 class="text-center"> {{$package->name}} </h3>
            </div>
            <div class="card-body">
                <div>
                    <h3>{{$package ->price}}</h3>
                    <h5>{{$package ->duration}} days</h5>
                </div>

                @if($userdata->package_id===$package->id)
                    <ul class="list-group rounded-0 list-group-flush">
                        <li class="list-group-item">Current</li>
                        <li class="list-group-item">Expire At - {{\Carbon\Carbon::parse($userdata->subscription_expires_at)->format("d M Y")}} </li>
                    </ul>

                @else
                    <ul class="list-group rounded-0 list-group-flush">
                        <li class="list-group-item">Counts - {{$package ->duration}} days</li>
                        <li class="list-group-item">Expire At - {{now()->addDays($package ->duration)->format("d M Y")}} </li>
                    </ul>
                @endif
                

                <div class="text-center">
                    <button type="button" id="pay-with-point" class="btn btn-sm rounded-0 add-to-cart  {{$userdata->package_id===$package->id ? 'disabled btn-secondary' : 'btn-primary'}}" data-package-id='{{$package->id}}' data-package-price ="{{$package->price}}" > Add Card </button>
                </div>
            </div>
        </div>
    </div>
@endforeach