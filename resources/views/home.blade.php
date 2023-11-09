@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Make a payment</div>

                <div class="card-body">
                    <form action="{{route('pay')}}" method="POST" id="paymentForm">
                        @csrf
                        <div class="row">
                            <div class="col-auto">
                                <div><label class="form-label">How much you want to pay?</label></div>
                                <input type="number" name="value" min="5" step="0.01" class="form-control" value="{{mt_rand(500, 100000) / 100}}" required>
                                <div>
                                    <small class="form-text text-muted">
                                        Use values with up to two decimal positions, using a dot "."
                                    </small>
                                </div>
                            </div>

                            <div class="col-auto">
                                <div><label class="form-label">Currency</label></div>
                                <select name="currency" class="form-select" required>
                                    @foreach ($currencies as $currency)
                                        <option value="{{$currency->iso}}">{{strtoupper($currency->iso)}}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="row mt-3">
                            <div class="col" id="toggler">
                                <div><label>Select the desired payment platform</label></div>
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

                        <div class="row mt-2">
                            <div class="col-auto">
                                <p class="border-bottom border-primary">
                                    @if (!optional(auth()->user())->hasActiveSubscription())
                                        Would you like a discount every time?
                                        <a href="{{route('subscribe.show')}}">Subscribe</a>
                                    @else
                                        You get a <strong>10% off</strong> as part of your subscription (This will be applied in the chechout).
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="text-center mt-3">
                            <button id="payButton" class="btn btn-outline-primary btn-lg" type="submit">Pay</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
