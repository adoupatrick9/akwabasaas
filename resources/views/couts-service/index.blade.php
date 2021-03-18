@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3>
        <i class="fa fa-angle-right"></i> Coût du service <span class="text-uppercase">{{ $service['Sce_nom_service'] }}</span>
        <a href="{{ url()->previous() }}" class="btn btn-danger" style="float: right">Retour <i class="fa fa-arrow-left"></i></a>
    </h3>
    <hr>
    <div class="col-md-12 text-center text-success chargeM">
        <h4>Chargement en cours...</h4>
    </div>
    <a data-toggle="modal" href="#myModalStoreCoutService">
        <div class="btn btn-primary" style="margin-bottom: 10px;">Ajouter un coût  <i class="fa fa-plus"></i></div>
    </a>
    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
          <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Intitulé</th>
                    <th>Devise</th>
                    <th>Coût borne</th>
                    <th>Borne inférieur</th>
                    <th>Borne supérieur</th>
                    <th>Coût mensuel</th>
                    <th>Coût trimestriel</th>
                    <th>Coût semestriel</th>
                    <th>Coût annuel</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($coutServices as $coutService)
                        <tr>
                        <td style="vertical-align: middle;">{{ $coutService['Sce_nom_service'] }}</td>
                        <td style="vertical-align: middle;"></td>
                        <td style="vertical-align: middle;"></td>
                        <td class="center">
                                <!-- Split button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-theme03">Actions</button>
                                <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#" id="{{ $coutService['idas_cout_service'] }}" class="editer">Modifier</a></li>
                                    <li><a href="#" id="{{ $coutService['idas_cout_service'] }}" class="supprimer">Supprimer</a></li>
                                </ul>
                            </div>
                        </td>
                        </tr>
                    @endforeach
                </tbody>
              </table>
          </div>
        </div>
        <!-- page end-->
      </div>

    @include('couts-service.create')
    @include('couts-service.edit')
  </section>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/coutService.js') }}"></script>
@endsection
