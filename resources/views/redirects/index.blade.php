<?php
/**
 * @author Jonathon Wallen
 * @date 18/4/17
 * @time 2:21 PM
 * @copyright 2008 - present, Monkii Digital Agency (http://monkii.com.au)
 */
?>
@extends('laravel-administrator.layout')

@section('title', 'Redirects')

@section('content')

    <h1>Manage redirects</h1>
    <div class="panel  panel__half">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full  create  solo-button">
                    <a href="{{ route('laravel-administrator-url-alias-create') }}" class="btn  btn--primary">
                        <span class="plus-span">
                            <svg class="icon icon-plus-circle"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#icon-plus-circle"></use></svg>
                        </span>
                        Add new redirect
                    </a>

                </div>
            </div>

        </div>
    </div>

    <div class="panel">
        <div class="panel__inner">

            <div class="panel__row">
                <div class="panel__full">
                    <h3>Existing redirects</h3>
                </div>
            </div>

            <div class="panel__row">
                <div class="panel__full">
                    <table class="sort-list dd-list table table-striped table-hover">
                        <tr>
                            <th class="col-2">From</th>
                            <th class="col-3">To</th>
                            <th class="col-5">&nbsp;</th>
                        </tr>
                        <tbody class=" sortable">
                        @foreach($redirects as $redirect)
                            <tr data-id="{{ $redirect->id }}">
                                <td class="col-3">{{ url($redirect->path) }}</td>
                                <td class="col-4">{!! url($redirect->system_path) !!}</td>
                                <td class="col-5">
                                    <a href="{{ route('laravel-administrator-url-alias-edit', [$redirect->id]) }}">Edit</a>
                                    {!! Form::open(['route' => ['laravel-administrator-url-alias-delete', $redirect->id],'class' => 'plain confirm']) !!}
                                    {!! Form::hidden('_method', 'DELETE') !!}
                                    <button type="submit">Delete</button>
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- This contains the content for Colorbox modal inline calls -->
    <div class='colorbox-inline'>
        <div id='confirm_content'>
            <h3>Are you sure you want to remove this entry?</h3>
            <a class="btn  btn--primary  confirm_link">Yes</a>
            <a class="btn  btn--tertiary  confirm_link">No</a>
        </div>
    </div>

@endsection
