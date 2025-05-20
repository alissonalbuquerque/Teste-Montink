<x-app-layout title="{{ __('Cupons') }}">

    <x-slot name="main">

        <div class="border border-rounded px-2">
            <h1 class="h2 text-muted"> {{ __('Cupom - :action', ['action' => __('Update')]) }}</h1>
        </div>

        <div class="border border-rounded my-4 p-4">

            <form action="{{route('cupom.update', ['id' => $model->id])}}" method="POST">

                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col">

                        <div class="mb-3">
                            <label for="code" class="form-label">{{__('Code')}}</label>
                            <input id="code" name="code" type="text" class="form-control @error('code') is-invalid @enderror" aria-describedby="cupom.code" value="{{ $model->code }}">
                            @error('code')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="start_date" class="form-label">{{__('Start Date')}}</label>
                            <input id="start_date" name="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" aria-describedby="cupom.start_date" value="{{ $model->start_date }}">
                            @error('start_date')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="end_date" class="form-label">{{__('End Date')}}</label>
                            <input id="end_date" name="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" aria-describedby="cupom.end_date" value="{{ $model->end_date }}">
                            @error('end_date')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="minimal_value" class="form-label">{{__('Minimal Value')}}</label>
                            <input id="minimal_value" name="minimal_value" type="number" min="0" step="0.01" class="form-control @error('minimal_value') is-invalid @enderror" aria-describedby="variant.minimal_value" value="{{ $model->minimal_value }}">
                            @error('minimal_value')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="percentage" class="form-label">{{__('Percentage')}}</label>
                            <input id="percentage" name="percentage" type="number" min="1" max="100" class="form-control @error('percentage') is-invalid @enderror" aria-describedby="variant.percentage" value="{{ $model->percentage }}">
                            @error('percentage')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="active" class="form-label">{{__('Active')}}</label>
                            <select id="active" name="active" class="form-select" aria-label="active">
                                @foreach ($active as $key => $value)
                                    @if($model->active == $key)
                                        <option value="{{$key}}" selected>{{$value}}</option>
                                    @else
                                        <option value="{{$key}}">{{$value}}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('active')
                                 <div class="invalid-feedback"> {{$message}} </div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="text-end">
                    <div class="btn-group">

                        <div class="mx-1">
                            <a href="{{ route('cupom.index') }}" class="btn btn-secondary">
                                <i class="bi bi-arrow-left-circle"></i> {{ __('Back') }}
                            </a>
                        </div>

                        <div class="mx-1">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bi bi-arrow-clockwise"></i> {{ __('Update') }}
                                </button>
                            </div>
                        </div>

                    </div>
                </div>

            </form>

        </div>

    </x-slot>

</x-app-layout>
