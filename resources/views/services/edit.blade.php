@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Modifier Service <span class="text-uppercase">{{ $service['Sce_nom_service'] }}</span></h3>
    <hr>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div id="message"></div>
        <form class="contact-form php-mail-form" role="form" action="{{ url('/services-update/'.$service['IDas_service']) }}" method="POST">
            @csrf
            <div class="form-group">
                Nom <em class="text-danger">*</em><input type="text" name="sce_nom_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $service['Sce_nom_service'] }}">
             </div>
             <div class="form-group">
                 Type <em class="text-danger">*</em><select name="sce_type" id="sce_type_service" class="form-control placeholder-no-fix">
                     @if($service['Sce_type_service'] == 1)
                        <option value="1" selected>Saas</option><option value="2">One premise</option>
                     @else
                        <option value="1" >Saas</option><option value="2" selected>One premise</option>
                     @endif
                 </select>
             </div>
             <input type="number" name="IDas_service" id="IDas_service" value="{{ $service['IDas_service'] }}" class="hidden">
             <div class="container text-danger">
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </div>
          <div>
                <a href="{{ url()->previous() }}" class="btn btn-default">Annuler <i class="fa fa-ban"></i></a>
                <button class="btn btn-theme" type="submit" id="submit">Modifier <i class="fa fa-edit"></i></button>
          </div>

        </form>
      </div>

  </section>
@endsection
