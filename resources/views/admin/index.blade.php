@extends('admin.layout.app')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    @lang('home.manage')
                </h1>
                <ol class="breadcrumb">
                    <li class="">
                        <i class="fa fa-dashboard"></i> @lang('home.home')
                    </li>
                    <li class="active">
                        <i class="fa fa-dashboard"></i> @lang('lang.chart')
                    </li>
                </ol>
            </div>
        </div>
        <div class="row">
            <form action="{{ route('albumChart') }}" method="get" id="form_order">
                <div class="col-md-4 mr-3">
                    <select class="custom-select custom-select-lg mb-3" name="time2">
                        <option selected>@lang('home.choose')</option>
                        <option value="m">@lang('home.month')</option>
                        <option value="Q">@lang('home.quarter')</option>
                        <option value="Y">@lang('home.year')</option>
                    </select>
                </div>
            </form>
            @include('admin.layout.albumChart')
        </div>
    @stop
