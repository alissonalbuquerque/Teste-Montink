<x-app-layout title="{{ __('Products') }}">

    <x-slot name="main">

        <form action="{{route('product.store')}}" method="POST">

            @csrf
            @method('POST')

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="row">
                <div class="col">

                    <div class="mb-3">
                        <label for="name" class="form-label">{{__('Name')}}</label>
                        <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" aria-describedby="product.name" value="{{ old('name')}}">
                    </div>

                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-success">{{ __('Create') }}</button>
            </div>

        </form>

    </x-slot>

</x-app-layout>
