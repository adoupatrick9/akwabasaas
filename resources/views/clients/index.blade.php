@extends('layouts.theme')

@section('content')
<section class="wrapper mt">
    <h3><i class="fa fa-angle-right"></i> Clients</h3>
    <hr>
    <div class="col-md-12 text-center text-success chargeM">
        <h4>Chargement en cours...</h4>
    </div>
    <a data-toggle="modal" href="#myModalStoreClient">
        <div class="btn btn-primary" style="margin-bottom: 10px;">Ajouter un client  <i class="fa fa-plus"></i></div>
    </a>
    <div class="row mb" style="margin: 0px 1px;">
        <!-- page start-->
        <div class="content-panel">
          <div class="adv-table" style="margin-left: 10px; margin-right: 10px;">
            <table cellpadding="0" cellspacing="0" border="0" class="display table table-bordered" id="hidden-table-info">
              <thead>
                <tr>
                  <th class="hidden-phone">Matricule</th>
                  <th>Nom</th>
                  <th>Adresse email</th>
                  <th>Téléphone mobile</th>
                  <th class="hidden-phone">Pays</th>
                  <th class="hidden-phone">Ville</th>
                  <th class="hidden-phone">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach($elements as $client)
                  <tr class="gradeC">
                    <td class="hidden-phone" style="vertical-align: middle;">{{ $client['ap_matricule_pers'] }}</td>
                    <td style="vertical-align: middle;" class="text-uppercase">{{ $client['NomComplet'] }}</td>
                    <td style="vertical-align: middle;">{{ $client['ap_email_pers'] }}</td>
                    <td style="vertical-align: middle;">{{ $client['ap_mobile_pers'] }}</td>
                    <td class="hidden-phone" style="vertical-align: middle;">{{ $client['ap_pays_pers'] }}</td>
                    <td class="hidden-phone" style="vertical-align: middle;">{{ $client['ap_ville_pers'] }}</td>
                    <td class="center hidden-phone">
                            <!-- Split button -->
                            <div class="btn-group">
                                <button type="button" class="btn btn-theme03">Actions</button>
                                <button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{ url('/factures/'.$client['ap_matricule_pers'].'/client/'.$client['IDas_personne'] ) }}">Factures</a></li>
                                    <li><a href="{{ url('/utilisateurs-service/'.$client['IDas_personne']).'/client'  }}">Services souscrits</a></li>
                                    <li><a href="{{ url('/utilisateurs-representant/'.$client['IDas_personne']).'/client'  }}">Représentants</a></li>
                                    <li><a href="#" id="{{ $client['IDas_personne'] }}" class="editer">Modifier</a></li>
                                    <li><a href="{{ url('/utilisateurs-actif-inactif/'.$client['IDas_personne']).'/client'  }}">Activer/Désactiver</a></li>
                                    <li><a href="#" id="{{ $client['IDas_personne'] }}" class="supprimer">Supprimer</a></li>
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

      @include('clients.create')
      @include('clients.edit')
  </section>
@endsection

@section('js')
    <script type="text/javascript" src="{{ asset('js/client.js') }}"></script>
@endsection

