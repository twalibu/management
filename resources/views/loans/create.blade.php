@extends('masters.tenant.app')

<!-- Page Title -->
@section('title')Service @stop 

<!-- Head Styles -->
@section('styles')
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

    <!-- Material Wizard CSS Files -->
    <link href="{{ asset('bower_components/material_bootstrap_wizard/assets/css/material-bootstrap-wizard.css') }}" rel="stylesheet" />
@stop

<!-- Page Header -->
@section('header')Add New Service @stop

<!-- Page Description -->
@section('desc')Create New Service @stop

<!-- Active Link -->
@section('active')Services @stop

<!-- Page Content -->
@section('content')
<div class="row">
	<div class="col-md-12"> 
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <p><strong>Whoops!</strong> There were some problems with your input.</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <!--      Wizard container        -->   
        <div class="wizard-container">
            <div class="card wizard-card" data-color="blue" id="wizard">
                <form action="{{ route('loans.store') }}" method="POST" accept-charset="UTF-8">
                    <input name="_token" value="{{ csrf_token() }}" type="hidden">
                    
                    <div class="wizard-header">
                        <h3 class="wizard-title">
                            New Service Registration
                        </h3>
                        <h5>Please fill the information accurately.</h5>
                    </div>

                    <div class="wizard-navigation">
                        <ul>
                            <li><a href="#details" data-toggle="tab">Details</a></li>
                        </ul>
                    </div>
                    
                    <div class="tab-content">
                        <div class="tab-pane" id="details">
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4 class="info-text"> Let's start with the basic details.</h4>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">people</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Select Client</label>
                                            <select class="form-control" name="client">      
                                                <option disabled="" selected=""></option>
                                                @foreach($tenant->clients as $client)
                                                    <option value="{{ $client->id }}" {{ old('client') == $client->id ? 'selected' : '' }}>{{ $client->first_name }} {{ $client->middle_name }} {{ $client->last_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">swap_horiz</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Select Service Type</label>
                                            <select class="form-control" name="type">      
                                                <option disabled="" selected=""></option>
                                                @foreach($tenant->loanTypes as $type)
                                                    <option value="{{ $type->id }}" {{ old('type') == $type->id ? 'selected' : '' }}> {{ $type->name }} | {{ $type->duration }} {{ str_plural('Month', $type->duration) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                   <!--  <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">done</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Loan Penalt <small>Per Day</small></label>
                                                <select class="form-control" name="penalt">      
                                                    <option disabled="" selected=""></option>
                                                    @foreach($tenant->overdues as $penalt)
                                                        <option value="{{ $penalt->id }}" {{ old('penalt') == $penalt->id ? 'selected' : '' }}>{{ ($penalt->penalt)*100 }}% Penalt Rate</option>
                                                    @endforeach
                                                </select>
                                        </div>
                                    </div> -->
                                </div>

                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">info</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Service Identity <small>(By The Company)</small></label>
                                            <input name="loan_identity" value="{{ old('loan_identity') }}" type="text" class="form-control">
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">attach_money</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Amount</label>
                                            <input name="amount" value="{{ old('amount') }}" type="number" class="form-control">
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">date_range</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Issued Date</label>
                                            <input name="date" value="{{ old('date') }}" type="date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="material-icons">home</i>
                                        </span>
                                        <div class="form-group label-floating">
                                            <label class="control-label">Office</label>
                                            <select class="form-control" name="office">
                                                <option disabled="" selected=""></option>
                                                @foreach($tenant->offices as $office)
                                                    <option value="{{ $office->id }}" {{ Sentinel::getUser()->staff->office->id == $office->id ? 'selected' : '' }}>{{ $office->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>                        
                    </div>

                    <div class="wizard-footer">
                        <div class="pull-right">
                            <input type='button' class='btn btn-next btn-fill btn-danger btn-wd' name='next' value='Next' />
                            <input type='submit' class='btn btn-finish btn-fill btn-danger btn-wd' name='finish' value='Finish' />
                        </div>
                        <div class="pull-left">
                            <input type='button' class='btn btn-previous btn-fill btn-default btn-wd' name='previous' value='Previous' />
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </form>
            </div>
        </div> <!-- wizard container --> 
    </div>        
</div>
@stop

<!-- Page Scripts -->
@section('scripts')
    <!-- Creative Tim -->
    <script src="{{ asset('bower_components/material_bootstrap_wizard/assets/js/material-bootstrap-wizard.js') }}"></script>
    <script src="{{ asset('bower_components/material_bootstrap_wizard/assets/js/jquery.bootstrap.js') }}" type="text/javascript"></script>
@stop