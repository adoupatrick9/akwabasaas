@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Modifier les informations de la promotion <span class="text-uppercase">{{ $data['pro_intitule'] }}</span> </h3>
    <hr>

    <form action="{{ url('/promotions-update/'.$data['IDas_promotion']) }}" method="POST">
        @csrf
                <div class="row">
                    <div class="col-md-6 form-group">
                       Intitulé <em class="text-danger">*</em><input type="text" name="pro_intitule" autocomplete="on" class="form-control placeholder-no-fix text-uppercase" value="{{ $data['pro_intitule'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Service <em class="text-danger">*</em><select name="Sce_code_service" id="Sce_code_service" class="form-control placeholder-no-fix">
                            @foreach($services as $service)
                                @if($service['sce_code_service'] == $data['Sce_code_service'])
                                    {{ $sel = "selected" }}
                                @else
                                    {{ $sel = "" }}
                                @endif
                                <option {{ $sel }} value="{{ $service['sce_code_service'] }}">{{ $service['Sce_nom_service'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        Devise <em class="text-danger">*</em><select name="Dev_code_devise" id="Dev_code_devise" class="form-control placeholder-no-fix">
                            @foreach($devises as $devise)
                                @if($devise['Dev_code_devise'] == $data['Dev_code_devise'])
                                    {{ $sel = "selected" }}
                                @else
                                    {{ $sel = "" }}
                                @endif
                                <option {{ $sel }} value="{{ $devise['Dev_code_devise'] }}">{{ $devise['Dev_intitule_devise'] }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        Début période <em class="text-danger">*</em><input type="date" name="pro_debut_periode" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['pro_debut_periode'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Fin période <em class="text-danger">*</em><input type="date" name="pro_fin_periode" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['pro_fin_periode'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Coût unitaire <em class="text-danger">*</em><input type="number" name="pro_cout_unitaire" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['pro_cout_unitaire'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Coût mensuel <em class="text-danger">*</em><input type="number" name="pro_cout_mensuel" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['pro_cout_mensuel'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Coût trimestriel <em class="text-danger">*</em><input type="number" name="pro_cout_trimestriel" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['pro_cout_trimestriel'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Coût semestriel <em class="text-danger">*</em><input type="number" name="pro_cout_semestriel" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['pro_cout_semestriel'] }}">
                    </div>
                    <div class="col-md-6 form-group">
                        Coût annuel <em class="text-danger">*</em><input type="number" name="pro_cout_annuel" autocomplete="on" class="form-control placeholder-no-fix" value="{{ $data['pro_cout_annuel'] }}">
                    </div>
                    <input type="number" name="IDas_promotion" id="IDas_promotion" value="{{ $data['IDas_promotion'] }}" class="hidden">
                </div>

                <div class="container text-danger col-md-12">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </div>
                <div>
                  <a href="{{ url('/promotions') }}" class="btn btn-default">Annuler <i class="fa fa-ban"></i></a>
                  <button class="btn btn-theme" type="submit">Modifier <i class="fa fa-edit"></i></button>
                </div>
    </form>
  </section>
@endsection
