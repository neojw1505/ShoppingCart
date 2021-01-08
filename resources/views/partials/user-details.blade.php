@extends('layouts.app')

@section('content')
{{-- {{dd($details)}} --}}
    @if ($details->isEmpty())
    <div class="card col-md-6 pt-5">
        <div class="card-header">
            <h1>&nbsp;Account Information</h1>
        </div>    
            <div class="card-body">
                <div class="card-row">
                    <b>Name:</b> 
                </div>
                <hr>
                <div class="card-row">
                    <b>Email:</b> 
                </div>
                <hr>
                <div class="card-row">
                    <b>Address:</b> 
                </div>
                <hr>
                <div class="card-row">
                    <b>Contact:</b> 
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{route('user-details-create')}}" class="btn btn-secondary w-50">Add New Address</a>
            </div>
        </div>        
    @else
    <div class="card col-md-6 pt-5" style="width:auto; height:auto;">
        <div class="card-header">
            <h1>&nbsp;Account Information</h1>
        </div>    
            <div class="card-body">
                <b>Name:</b> {{$details[0]->firstname}} {{$details[0]->lastname}}
                <hr>
                <b>Email:</b> {{$details[0]->email}}
                <hr>
                <b>Address:</b> {{$details[0]->postalcode}} {{$details[0]->address}}
                <hr>
                <b>Contact:</b> {{$details[0]->mobile}}
            </div>
            <div class="card-footer text-center">
                <a href="{{route('user-details-edit')}}" class="btn btn-secondary w-50">Edit</a>
            </div>
        </div>
    @endif
@endsection