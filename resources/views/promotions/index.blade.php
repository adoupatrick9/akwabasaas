@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Promotions</h3>
    <hr>
    <div class="col-md-12 text-center text-success chargeM">
        <h4>Chargement en cours...</h4>
    </div>
    <a data-toggle="modal" href="{{ url('/promotions#myModalStorePromo') }}" >
        <div class="btn btn-primary" style="margin-bottom: 10px;">Ajouter une promotion  <i class="fa fa-plus"></i></div>
    </a>
    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
          <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
                <thead>
                  <tr>
                    <th>Intitulé</th>
                    <th>Service</th>
                    <th>Devise</th>
                    <th class="hidden-phone">Cout unitaire</th>
                    <th class="hidden-phone">Période</th>
                    <th>Inactif</th>
                    <th class="hidden-phone">Actions</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($promotions as $promotion)
                        <tr>
                        <td style="vertical-align: middle;">{{ $promotion['pro_intitule'] }}</td>
                        <td style="vertical-align: middle;">{{ $promotion['sce_nom_service'] }}</td>
                        <td style="vertical-align: middle;">{{ $promotion['dev_intitule_devise'] }}</td>
                        <td style="vertical-align: middle;" class="hidden-phone">{{ number_format($promotion['pro_cout_unitaire'], 2, ',', ' ') }}</td>
                        <td style="vertical-align: middle;" class="hidden-phone">{{ date("d-m-Y", strtotime($promotion['pro_debut_periode']))  }} -- {{ date("d-m-Y", strtotime($promotion['pro_fin_periode']))  }}</td>
                        <td style="vertical-align: middle;" class="center">
                            @if($promotion['pro_inactif'] == true)
                                <img src="{{ asset('img/ok.png') }}" alt="ok" width="25" height="25">
                            @endif
                        </td>
                        <td class="center hidden-phone">
                                <!-- Split button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-theme03 btn-md">Actions</button>
                                <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/promotions-edit/'.$promotion['idas_promotion'].'/promotions') }}" id="{{ $promotion['idas_promotion'] }}" class="editer">Modifier</a></li>
                                    <li><a href="{{ url('/promotions-actif-inactif/'.$promotion['idas_promotion'] ) }}">Activer/Désactiver</a></li>
                                    <li><a href="{{ url('/promotions-delete/'.$promotion['idas_promotion'] ) }}" id="{{ $promotion['idas_promotion'] }}" class="supprimer">Supprimer</a></li>
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

    @include('promotions.create')
    @include('promotions.edit')

  </section>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/promotion.js') }}"></script>
@endsection
