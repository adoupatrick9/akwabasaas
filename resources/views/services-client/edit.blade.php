@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Modifier Service client </h3>
    <hr>

    <div class="col-lg-6 col-md-6 col-sm-6">
        <div id="message"></div>
        <form class="contact-form php-mail-form" role="form" action="{{ url('/services-client-update/'.$data['IDas_service_client'].'/'.$IDclient) }}" method="POST">
            @csrf

            <div class="col-md-6 form-group">
                Service <em class="text-danger">*</em><select name="Sce_code_service" id="Sce_code_service" class="form-control placeholder-no-fix">
                    @foreach($services as $service)
                        <option value="{{ $service['sce_code_service'] }}">{{ $service['Sce_nom_service'] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6 form-group">
                Périodicité <em class="text-danger">*</em><select name="sc_periodicite" id="sc_periodicite" class="form-control placeholder-no-fix">
                    <option value="1">Mensuelle</option>
                    <option value="2">Trimestrielle</option>
                    <option value="2">Semestrielle</option>
                    <option value="2">Annuel</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
               Début service <em class="text-danger">*</em><input type="date" name="sc_debut_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $data['sc_debut_service']}}">
            </div>
            <div class="col-md-6 form-group">
               Fin service <em class="text-danger">*</em><input type="date" name="sc_fin_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $data['sc_fin_service']}}">
            </div>
            <div class="col-md-6 form-group">
               Date souscription <em class="text-danger">*</em><input type="date" name="sc_date_souscription" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $data['sc_date_souscription']}}">
            </div>
            <div class="col-md-6 form-group">
               Début souscription <em class="text-danger">*</em><input type="date" name="sc_debut_souscription" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $data['sc_debut_souscription']}}">
            </div>
            <div class="col-md-6 form-group">
               Fin souscription <em class="text-danger">*</em><input type="date" name="sc_fin_souscription" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $data['sc_fin_souscription']}}">
            </div>
            <div class="col-md-6 form-group">
                Option facturation <em class="text-danger">*</em><select name="sc_option_facturation" id="sc_option_facturation" class="form-control placeholder-no-fix">
                    <option value="1">Mensuelle</option>
                    <option value="2">Trimestrielle</option>
                    <option value="2">Semestrielle</option>
                    <option value="2">Annuel</option>
                </select>
            </div>
            <div class="col-md-6 form-group">
               Quantité<em class="text-danger">*</em><input type="number" name="sc_quantite" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $data['sc_quantite']}}">
            </div>
            <div class="col-md-6 form-group">
               Coût service<em class="text-danger">*</em><input type="number" name="sc_cout_service" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $data['sc_cout_service']}}">
            </div>

            <input type="number" name="IDas_service_client" id="IDas_service_client" class="hidden" value="{{ $data['IDas_service_client'] }}">

            <div class="col-md-6 container text-danger">
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

