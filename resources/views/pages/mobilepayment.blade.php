@extends('layouts.master_payment', ['pageTitle'=>'Mobile Money Payment'])
@section('content')
<div class="row">
	<h1>Mobile Money Payment</h1>
<form id="paymentForm" name="paymentForm" action="makeMomoPayment" method="post" enctype="multipart/form-data">
{{ csrf_field() }}
<div class="row jumbotron">
    @error('firstName')
        <span class="alert-danger">
            {{$message}}
        </span>
    @enderror
	<div class="form-group">
		<label for="customerFirstName" class="col-md-6 control-label">First Name</label>
		<div class="col-md-6">
			<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Fisrt Name" />
		</div>
	</div>

    @error('lastname')
        <span class="alert-danger">
            {{$message}}
        </span>
    @enderror
	<div class="form-group">
		<label for="customerLastname" class="col-md-6 control-label">Last Name</label>
		<div class="col-md-6">
			<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" />
		</div>
	</div>


    @error('email')
    <span class="alert-danger">
        {{$message}}
    </span>
    @enderror
	<div class="form-group">
		<label for="customerEmail" class="col-md-6 control-label">Email Address</label>
		<div class="col-md-6">
			<input type="text" class="form-control" id="email" name="email" placeholder="Email Address" />
		</div>
	</div>

    @error('phoneNumber')
    <span class="alert-danger">
        {{$message}}
    </span>
    @enderror
	<div class="form-group">
		<label for="customerPhoneNumber" class="col-md-6 control-label">Phone Number</label>
		<div class="col-md-6">
			<input type="text" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="Phone Number" />
		</div>
	</div>


    @error('description')
    <span class="alert-danger">
        {{$message}}
    </span>
    @enderror
	<div class="form-group">
		<label for="description" class="col-md-6 control-label">Description</label>
		<div class="col-md-6">
			<input type="text" class="form-control" id="description" name="description" value="Entrance Exam"/>
			<input type="hidden" class="form-control" id="referenceNumber" name="referenceNumber" value="refNumber" />

		</div>
	</div>

    @error('amount')
    <span class="alert-danger">
        {{$message}}
    </span>
    @enderror
	<div class="form-group">
		<label for="amount" class="col-md-6 control-label">Amount</label>
		<div class="col-md-6">
			<input type="text" class="form-control" id="amount" name="amount" placeholder="Amount that you are paying" />
			<input type="hidden" class="form-control" id="serviceKey" name="serviceKey" value="serviceKey" />
		</div>
	</div>



    @error('currency')
    <span class="alert-danger">
        {{$message}}
    </span>
    @enderror
	<div class="form-group">
		<label for="description" class="col-md-6 control-label">Currency Code</label>
		<div class="col-md-6">
			<select class="form-control" id="currency" name="currency">
				<option value="NR">Naira</option>
				<option value="LRD">LRD</option>
				<option value="USD">USD</option>
				<option value="EUR">Euro</option>
				<option value="GBD">GBD</option>
			</select>
		</div>
	</div>
	<br/>
	<br/>

<!--</div>-->
 <div class="row">
 	<div class="form-group">
                <div class="col-lg-4">
                    <button type="submit" class="btn btn-danger btn-lg" role="button"  id="btnsubmit"  name="submit">
                        <span class="glyphicon glyphicon-save"></span>Save</button>
                </div>
                <div class="col-lg-4">
                    <button type="reset" class="btn btn-default btn-lg" role="button" name="cancel">
                        <span class="glyphicon glyphicon-erase"></span>
                        Cancel</button>
   		         </div>
   </div>
 </div>
</form>
</div>

@endsection
