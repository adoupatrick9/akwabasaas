@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Edition de devise</h3>
    <hr>
    <div class="col-lg-6 col-md-6 col-sm-6">
        <div id="message"></div>
        <form class="contact-form php-mail-form" role="form" action="{{ url('/devises-update/'.$devise['IDas_devise']) }}" method="POST">
            @csrf
            <div class="form-group">
                Devise <em class="text-danger">*</em><input type="text" name="Dev_intitule_devise" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $devise['Dev_intitule_devise'] }}">
             </div>
             <input type="number" name="IDas_devise" id="IDas_devise" value="{{ $devise['IDas_devise'] }}" class="hidden">
             <div class="container text-danger">
                 @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                 @endforeach
             </div>
          <div>
                <a href="{{ url('/configurations') }}" class="btn btn-default">Annuler <i class="fa fa-ban"></i></a>
                <button class="btn btn-theme" type="submit" id="submit">Modifier <i class="fa fa-edit"></i></button>
          </div>

        </form>
      </div>
  </section>
@endsection
