<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 8:59 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('vendor/laravel-administrator.layout')

@section('title', 'Redirects')

@section('content')
    <h1>Create new redirect</h1>
    <p><a href="{{ route('laravel-administrator-url-alias') }}">Back to redirects overview</a></p>
    {!! Form::open(['route' => ['laravel-administrator-url-alias-post'], 'class' => 'warn-on-change']) !!}
    <div class="panel">
        <div class="panel__inner">
            <div class="panel__row">
                <div class="panel__full">
                    <h3>Redirect from</h3>
                </div>
                <div class="panel__full">
                    <fieldset class="{{ $errors->has('aliased_path') ? 'error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon">{{ url('/') }}/</span>
                            {!! Form::text('aliased_path', null, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form__error">{{ $errors->first('aliased_path') }}</div>
                    </fieldset>
                </div>
            </div>

            <div class="panel__row">
                <div class="panel__full">
                    <h3>Redirect to</h3>
                </div>
                <div class="panel__full">
                    <fieldset class="{{ $errors->has('system_path') ? 'error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon">{{ url('/') }}/</span>
                            {!! Form::text('system_path', null, array('class' => 'form-control')) !!}
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
