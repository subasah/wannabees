@extends('layouts.app')

@section('content')
<?php 
use App\Company;
$company = Company::find(1);
?>
<div class="container">
    <div class="card">
      <div class="card-header">
       Client Details
      </div>
      <div class="card-body">
        
        <h1>{{ $company->name }}</h1>
        <div class="tab-content" id="myTabContent">
              <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="form-group row">
                        <label for="address" class="col-sm-2 col-form-label">Business Address</label>
                        <div class="col-sm-10">
                          <label class="form-control-plaintext" id="address">{{ $company->address }}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="phone_number" class="col-sm-2 col-form-label">Phone Numbder</label>
                        <div class="col-sm-10">
                          <label class="form-control-plaintext" id="phone_number"> {{ $company->phone_number }}</label>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="website" class="col-sm-2 col-form-label">Website</label>
                        <div class="col-sm-10">
                          <label class="form-control-plaintext" id="website"> <a target="_blank" href="{{ $company->website}}"> {{ $company->website }}</a></label>
                        </div>
                    </div>
              </div>
              <div class="tab-pane fade" id="opening" role="tabpanel" aria-labelledby="opening-tab">

                <ul id="opening_hourshower"class="list-group">

                </ul>

             </div>
        </div>

      </div>
      <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#opening" role="tab" aria-controls="opening" aria-selected="false">Opening Hours</a>
          </li>
        </ul>
    </div>
</div>

<script async defer
            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCuEE-lDXhyXd57q12hQqE4WsuGGx838Gk&libraries=places&callback=getOpeningHours">
</script>
<script type="text/javascript">

function getOpeningHours() {

    var opening_hourshower = new google.maps.Map(document.getElementById('opening_hourshower'), {
        center: {lat: -33.866, lng: 151.196},
        zoom: 15
    });

    var infowindow = new google.maps.InfoWindow();
    var service = new google.maps.places.PlacesService(opening_hourshower);
    var today = new Date();
    var day = today.getDay();

    service.getDetails({
            placeId: '{{ $company->place_id }}'
        },
        function(place, status) {
            
            if (status === google.maps.places.PlacesServiceStatus.OK) {

                badgeHtml = '<span class="badge '+ ((place.opening_hours.open_now)?"badge-success":"badge-danger" ) + ' ">' + ((place.opening_hours.open_now)?"Open":"Closed" ) + '</span>';

                textHtml = '<li class="list-group-item ' + ((day==1)?'active' : '') + '">' + place.opening_hours.weekday_text[0] + '</li>' +

                '<li class="list-group-item ' + ((day==2)?'active' : '') + '">' + place.opening_hours.weekday_text[1] + '</li>' +

                '<li class="list-group-item ' + ((day==3)?'active' : '') + '">' + place.opening_hours.weekday_text[2] + '</li>' +

                '<li class="list-group-item ' + ((day==4)?'active' : '') + '">' + place.opening_hours.weekday_text[3] + '</li>' +

                '<li class="list-group-item ' + ((day==5)?'active' : '') + '">' + place.opening_hours.weekday_text[4] + '</li>' +
                '<li class="list-group-item ' + ((day==6)?'active' : '') + '">' + place.opening_hours.weekday_text[5] + '</li>' +

                '<li class="list-group-item ' + ((day==0)?'active' : '') + '">' + place.opening_hours.weekday_text[6] + '</li>';

                var el = document.getElementById('opening_hourshower');
                el.innerHTML = textHtml;
                $("li.list-group-item.active").append(badgeHtml);  
            }
        });
}
</script>

@endsection
