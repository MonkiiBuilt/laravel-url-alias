@extends('vendor/laravel-administrator.layout')

@section('title', 'Url Alias')

@section('content')
    <h1>URL Alias</h1>

    {!! $tabs !!}

    {!! Form::open(['route' => ['laravel-administrator-url-alias-store', $page_id], 'class' => 'form-horizontal']) !!}
    {!! Form::hidden('_method', 'POST') !!}
    {!! Form::hidden('alias_id', $alias_id) !!}
    {!! Form::hidden('id') !!}
    <div class="panel">
        <div class="panel__inner">
            <div class="panel__row">
                <div class="panel__full">
                    <h3>Alias</h3>
                </div>
                <div class="panel__full">
                    <fieldset class="{{ $errors->has('system_path') ? 'error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon">{{ url('/') }}/</span>
                            {!! Form::text('aliased_path', $aliased_path, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form__error">{{ $errors->first('system_path') }}</div>
                    </fieldset>
                </div>
            </div>
        </div>
    </div>

    {!! Form::submit('Save', ['name' => 'submit']) !!}
    {!! Form::close() !!}

@endsection
