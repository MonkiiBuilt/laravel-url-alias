<?php
/**
 * @author Jonathon Wallen
 * @date 19/4/17
 * @time 11:32 AM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('laravel-administrator.layout')

@section('title', 'Redirects')

@section('content')
    <h1>Edit redirect</h1>
    <p><a href="{{ route('laravel-administrator-url-alias') }}">Back to redirects overview</a></p>
    {!! Form::model($redirect, ['route' => ['laravel-administrator-url-alias-put', 'id' => $redirect->id], 'class' => 'warn-on-change']) !!}
    {!! Form::hidden('_method', 'PUT') !!}
    {!! Form::hidden('id') !!}
    <div class="panel">
        <div class="panel__inner">
            <div class="panel__row">
                <div class="panel__full">
                    <h3>Redirect from</h3>
                </div>
                <div class="panel__full">
                    <fieldset class="{{ $errors->has('path') ? 'error' : '' }}">
                        <div class="input-group">
                            <span class="input-group-addon">{{ url('/') }}/</span>
                            {!! Form::text('path', null, array('class' => 'form-control')) !!}
                        </div>
                        <div class="form__error">{{ $errors->first('path') }}</div>
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
