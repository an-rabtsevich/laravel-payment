@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Subscribe</div>

                <div class="card-body">
                    <form action="{{route('subscribe.store')}}" method="POST" id="paymentForm">
                        @csrf

                        <div class="row">
                            <div class="col">
                                <div class="mb-2"><label>Select your plan</label></div>
                                <div class="form-group">
                                    @foreach ($plans as $plan)
                                        <input  type="radio" 
                                                class="btn-check" 
                                                name="plan" 
                                                value="{{$plan->slug}}" 
                                                id="paln{{$plan->id}}" 
                                                autocomplete="off">
                                        <label class="btn btn-outline-info" 
                                            for="paln{{$plan->id}}">
                                            <p class="h2 font-weight-bold text-capitalize">{{$plan->slug}}</p>
                                            <p class="display-4 text-capitalize">{{$plan->visual_price}}</p>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col" id="toggler">
                                <div class="mb-2"><label>Select the desired payment platform</label></div>
                                <div class="form-group">
                                    @foreach ($paymentPlatforms as $paymentPlatform)
                                        <input data-bs-target="#{{$paymentPlatform->name}}Collapse" 
                                                data-bs-toggle="collapse" 
                                                type="radio" 
                                                class="btn-check" 
                                                name="payment_platform" 
                                                value="{{$paymentPlatform->id}}" 
                                                id="platform{{$paymentPlatform->id}}" 
                                                autocomplete="off">
                                        <label class="btn btn-outline-secondary" 
                                            for="platform{{$paymentPlatform->id}}">
                                            <img class="img-thumbnail" src="{{asset($paymentPlatform->image)}}" alt="">
                                        </label>
                                    @endforeach
                                </div>

                                @foreach ($paymentPlatforms as $paymentPlatform)
                                    <div id="{{$paymentPlatform->name}}Collapse" class="collapse" data-bs-parent="#toggler">
                                        @includeIf('components.' . strtolower($paymentPlatform->name) . '-collapse')
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button id="payButton" class="btn btn-outline-primary btn-lg" type="submit">Subscribe</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
